<?php

namespace Database\Seeders;

use App\Models\CFTDepartments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CFTSeeder extends Seeder
{
    /**
     * Run the database seeds.  
     *
     * @return void
     */
    public function run()
    {
        $group  = new CFTDepartments();
        $group->id = 1;
        $group->name = "Production";
        $group->save();

        $group  = new CFTDepartments();
        $group->id = 2;
        $group->name = "Warehouse";
        $group->save();

        $group  = new CFTDepartments();
        $group->id = 3;
        $group->name = "Quality Control";
        $group->save();

        $group  = new CFTDepartments();
        $group->id = 4;
        $group->name = "Quality Assurance";
        $group->save();


        $group  = new CFTDepartments();
        $group->id = 5;
        $group->name = "Engineering";
        $group->save();

        $group  = new CFTDepartments();
        $group->id = 6;
        $group->name = "Analytical Development Laboratory";
        $group->save();

        $group  = new CFTDepartments();
        $group->id = 7;
        $group->name = "Process Development Laboratory / Kilo Lab";
        $group->save();

        $group  = new CFTDepartments();
        $group->id = 8;
        $group->name = "Technology Transfer/Design";
        $group->save();

        $group  = new CFTDepartments();
        $group->id = 9;
        $group->name = "Environment, Health & Safety";
        $group->save();

        $group  = new CFTDepartments();
        $group->id = 10;
        $group->name = "Human Resource & Administration";
        $group->save();

        $group  = new CFTDepartments();
        $group->id = 11;
        $group->name = "Information Technology";
        $group->save();

        $group  = new CFTDepartments();
        $group->id = 12;
        $group->name = "Project management";
        $group->save();

       

    }
}
