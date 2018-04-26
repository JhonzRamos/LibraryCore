<?php

use Illuminate\Database\Seeder;

class RelationshipSeedPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            1 => [
                'relationship' => [1, 2, 3],
            ],

        ];

        foreach ($items as $id => $item) {
            $relationship = \App\Relationship::find($id);

            foreach ($item as $key => $ids) {
                $relationship->{$key}()->sync($ids);
            }
        }
    }
}
