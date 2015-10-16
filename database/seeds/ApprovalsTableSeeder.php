<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Approvals as Approvals;

class ApprovalsTableSeeder extends Seeder
{
    protected $approvalsValues = array('Pendding','Approved', 'Waiting','Canceled');
    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('approvals')->truncate();

        foreach ($this->approvalsValues as $status) {

            DB::table('approvals')->insert([
                'status' => 1,
                'name'   => $status
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
