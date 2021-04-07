<?php

namespace App\Http\Repositories;

use App\Models\Course;
use App\Http\Repositories\BaseRepository;

class CourseRepository extends BaseRepository{
    
    protected $courseModel;

    public function __construct(Course $courseModel){
        $this->courseModel = $courseModel;
    }

    public function list(){
        return $this->courseModel->orderBy('name', 'asc')->paginate(10);
    }

    public function create(array $request){
        $data = (object) $request;
        $course = Course::create([
            'id' => $this->generateUuId(),
            'name' => $data->name,
            'description' => $data->description,
            'course_code' => rand(2,6),
            'course_number' => rand(2,5),
            'course_lecturer' => 'Abas'
        ]);

        if (!$course){
            return [
                'status_code' => 422,
                'message' => 'Invalid values'
            ];
        }

        return $course;
    }

    public function update(array $request, $id){

        $data = (object) $request;

        $course = $this->courseModel->findorFail($id); # Find works as well

        if(!$course){
            return [
                "status_code"=> 422,
                "message"=> "wrong"
            ];
        }
        $course->update([
            'name' => $data->name,
            'description' => $data->description,
        ]);
        
        return $course;       
    }

    public function getOneCourse($id){

        $course = $this->courseModel->where('id', $id)->get();
        
        if(!$course){
            return [
                'status_code' => 422,
                'message' => 'Wrong'
            ];
        }

       return $course;
    }

    public function deleteCourse($id){
        $course = $this->courseModel->where('id', $id)->delete();
        if (!$course){
            return [
                'status_code' => 422,
                'message' => 'Wrong'
            ];
        }

        return $course;
    }

   
}