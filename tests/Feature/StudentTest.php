<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    /** @test*/
    public function canCreateStudent()
    {
        $data = [
            'student_number' => 11141,
            'firstname' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'course_code' => 'CS201',
            'course_description' => 'Computer Science 2',
            'grade' => 'D'
        ];

        $response = $this->json('POST', '/api/v1', $data);

        $response->assertStatus(201)
            ->assertJson(compact('data'));

        $this->assertDatabaseHas('students', [
            'student_number' => $data['student_number'],
            'firstname' => $data['firstname'],
            'surname' => $data['surname'],
            'course_code' => $data['course_code'],
            'course_description' => $data['course_description'],
            'grade' => $data['grade'],
        ]);
    }
}
