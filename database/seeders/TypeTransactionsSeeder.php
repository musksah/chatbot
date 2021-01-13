<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeTransaction;


class TypeTransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeTransaction::create([
            'name'=>'Deposite'
        ]);
        TypeTransaction::create([
            'name'=>'Withdraw'
        ]);
        TypeTransaction::create([
            'name'=>'Account Balance'
        ]);
    }
}
