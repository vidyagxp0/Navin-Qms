<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $group  = new Customer();
        $group->customer_type = "Vendor";
        $group->customer_name = "Customer";
        $group->contact_no = "987654321";
        $group->industry = "NA";
        $group->region = "NA";
        $group->remarks = "NA";
        $group->email = "customer@gmail.com";
        $group->status = "Active";
        $group->customer_id = 1;
        $group->id = 1;
        $group->save();

    }
}
