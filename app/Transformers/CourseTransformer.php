<?php

namespace App\Transformers;

use App\Models\Course;
use League\Fractal\TransformerAbstract;

class CourseTransformer extends TransformerAbstract
{
   
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Course $course)
    {
        return [
            'id' => $course->id,
            'name' => $course->name,
            'description' => $course->description,
            'course_number' => $course->course_number,
            'course_code' => $course->course_code,
            // 'course_lecturer' => $course->course_lecturer,
        ];
    }
}
