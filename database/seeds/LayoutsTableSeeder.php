<?php
use App\Layout;
use Illuminate\Database\Seeder;
class LayoutsTableSeeder extends Seeder
{
    public function run()
    {
        $layouts = [
            ['name' => 'Test'],
            ['name' => 'Basic'],
            ['name' => 'HTML'],
        ];
        foreach ($layouts as $layout) {
            Layout::updateOrCreate($layout);
        }
    }
}
