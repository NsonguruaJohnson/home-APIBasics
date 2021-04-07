<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\CourseTransformer;
use App\Http\Repositories\CourseRepository;

class CourseController extends Controller
{
    private $courseRepository;
    private $courseTransformer;

    public function __construct(CourseRepository $courseRepository, CourseTransformer $courseTransformer){
        $this->courseRepository = $courseRepository;
        $this->courseTransformer = $courseTransformer;
    }

    public function list(){
        $course = $this->courseRepository->list();
        return $this->successWithPages($course, $this->courseTransformer, 'courses');
    }

    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $course = $this->courseRepository->create($request->all());

        if(!isset($course['status_code'])){
            return $this->transform($course, $this->courseTransformer);
        }

        return $this->handleErrorResponse($course);
    }

    public function update(Request $request, $id){
        // dd($request);
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $course = $this->courseRepository->update($request->all(), $id);
        // dd($course);

        if(!isset($course['status_code'])){
            return $this->transform($course, $this->courseTransformer);
        }

        return $this->handleErrorResponse($course);

    }

    public function getOneCourse($id){
        $course = $this->courseRepository->getOneCourse($id);

        if (!isset($course['status_code'])){
            return $this->transform($course, $this->courseTransformer);
        }

        return $this->handleErrorResponse($course);
    }

    public function deleteCourse($id){
        $course = $this->courseRepository->deleteCourse($id);

        if (isset($course['status_code'])){
            return $this->handleErrorResponse($course);
        }

        return response()->json([
            'message' => 'Course Deleted'
        ]);

    }
}
