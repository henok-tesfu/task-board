<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;

class ProjectsTest extends TestCase
{
    use WithFaker,RefreshDatabase;
   

   /** @test */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $attributes =[
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph()
        ]; 


       $this->post('/projects',$attributes);
       
       $this->assertDatabaseHas('projects',$attributes);

       $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    
    public function a_project_requires_title()
    {
        $attributes = Project::factory()->raw(['title' =>'' ]);
        $this->post('/projects',$attributes)->assertSessionHasErrors('title');
        
    }

     /** @test */
    
     public function a_project_requires_description()
     {
 
        $attributes = Project::factory()->raw(['description' =>'' ]);
         $this->post('/projects',$attributes)->assertSessionHasErrors('description');
         
     }


      /** @test */
    
      public function a_user_can_view_a_project()
      {
        $this->withoutExceptionHandling();
            $project =   Project::factory()->create();
             $this->get('/projects/'.$project->id)->assertSee('title')->assertSee('description');

            
          
      }


}
