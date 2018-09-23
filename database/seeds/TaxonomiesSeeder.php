<?php

use Illuminate\Database\Seeder;

class TaxonomiesSeeder extends Seeder
{

    protected $dishes =[];

    /** @var $restaurant \App\Model\Restaurant */
    protected $restaurant;

    /**
     * Run the database seeds.
     * @return void
     */
    public function run(): void
    {
        $this->getRestaurantOrCreate();
        $this->createTaxonomies();
        $this->createTags();
        $this->createTaxonomiesSides();
    }

    public function getRestaurantOrCreate(): void
    {
        $this->restaurant = \App\Model\Restaurant::all()->first();
        if(!$this->restaurant instanceof \App\Model\Restaurant){
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Object not found');
        }
    }

    public function createTaxonomies(): void
    {
        $dishes =[
            ['name' => 'Bandeja paisa', 'image_path' => '67bead9a4203c3fa8a93e7342d5cf73c.jpg'],
            ['name' => 'Chuleta valluna', 'image_path' => '5e80b1e0a4ccb66758d2aff75c94f9cf.jpg'],
            ['name' => 'Ajiaco', 'image_path' => '880b0173ef7849261f3fd7325c623d47.jpg'],
            ['name' => 'Lomo salteado', 'image_path' => '91c9a28324f7a2161193298f6e4aaa0a.jpg'],
            ['name' => 'Pollo a la brasa', 'image_path' => '6cb7436ac6b1b554cc3b71d9ee91f923.jpg'],
            ['name' => 'Tacos al pastor', 'image_path' => '556d83b14c5c8362a2f85d57747b6474.jpg'],
            ['name' => 'Enchiladas mexicanas', 'image_path' => 'e8cc8391d10e879a0b12a198dafec0de.jpg'],
        ];

        $taxonomy = null;

        foreach ($dishes as $key => $dish){
            $dish = factory(\App\Model\Product::class)->create([
                'name' => $dishes[$key]['name'],
                'image_path' => '/uploads/' . $dishes[$key]['image_path'],
                'restaurant_id' => $this->restaurant->id
            ]);

            if($taxonomy === null){
                $taxonomy = factory(\App\Model\Taxonomy::class)->create([
                    'name' => 'meals',
                    'type' => 'category',
                    'restaurant_id' => $this->restaurant->id
                ]);
            }

            $dish->taxonomies()->save($taxonomy);
            $this->dishes[] = $dish;
        }
    }

    public function createTags(): void
    {
        $tags = [
            [
                ['name' => 'Monday', 'type' => 'tag'],
                ['name' => 'Colombian Food', 'type' => 'tag'],
                ['name' => 'Bean', 'type' => 'tag'],
                ['name' => 'Rice', 'type' => 'tag']
            ],
            [
                ['name' => 'Thursday', 'type' => 'tag'],
                ['name' => 'Colombian Food', 'type' => 'tag'],
                ['name' => 'Pork', 'type' => 'tag'],
                ['name' => 'Rice', 'type' => 'tag']
            ],
            [
                ['name' => 'Saturday', 'type' => 'tag'],
                ['name' => 'Colombian Food', 'type' => 'tag'],
                ['name' => 'Chicken', 'type' => 'tag'],
                ['name' => 'Soup', 'type' => 'tag']
            ],
            [
                ['name' => 'Tuesday', 'type' => 'tag'],
                ['name' => 'Peruvian Food', 'type' => 'tag'],
                ['name' => 'Steak', 'type' => 'tag'],
                ['name' => 'Beef', 'type' => 'tag']
            ],
            [
                ['name' => 'Tuesday', 'type' => 'tag'],
                ['name' => 'Peruvian Food', 'type' => 'tag'],
                ['name' => 'Chicken', 'type' => 'tag'],
                ['name' => 'Rice', 'type' => 'tag']
            ],
            [
                ['name' => 'Wednesday', 'type' => 'tag'],
                ['name' => 'Mexican Food', 'type' => 'tag'],
                ['name' => 'Beef', 'type' => 'tag'],
                ['name' => 'Guacamole', 'type' => 'tag']
            ],
            [
                ['name' => 'Friday', 'type' => 'tag'],
                ['name' => 'Mexican Food', 'type' => 'tag'],
                ['name' => 'Chicken', 'type' => 'tag'],
                ['name' => 'Spicy', 'type' => 'tag']
            ],

        ];

        foreach ($this->dishes as $key => $dish){
            foreach ($tags[$key] as $item){
                $taxonomy = \App\Model\Taxonomy::where('name', '=', $item['name'])
                    ->where('type', '=', $item['type'])
                    ->first();

                if(!$taxonomy){
                    $taxonomy = factory(\App\Model\Taxonomy::class)->create([
                        'name' => $item['name'],
                        'type' => $item['type'],
                        'restaurant_id' => $this->restaurant->id
                    ]);
                }

                $dish->taxonomies()->save($taxonomy);
            }
        }
    }

    public function createTaxonomiesSides(): void
    {
        $dishes =[
            ['name' => 'Mango juice', 'image_path' => '67bead9a4203c3fa8a93e7342d5cf73c.jpg', 'category' => [
                    'name' => 'juice',
                    'type' => 'side'
                ]
            ],
            ['name' => 'Pineapple juice', 'image_path' => '67bead9a4203c3fa8a93e7342d5cf73c.jpg', 'category' => [
                    'name' => 'juice',
                    'type' => 'side'
                ]
            ],
            ['name' => 'Guava juice', 'image_path' => '67bead9a4203c3fa8a93e7342d5cf73c.jpg', 'category' => [
                    'name' => 'juice',
                    'type' => 'side'
                ]
            ],
            ['name' => 'White rice', 'image_path' => '67bead9a4203c3fa8a93e7342d5cf73c.jpg', 'category' => [
                    'name' => 'meals',
                    'type' => 'side'
                ]
            ],
            ['name' => 'French fries', 'image_path' => '67bead9a4203c3fa8a93e7342d5cf73c.jpg', 'category' => [
                    'name' => 'meals',
                    'type' => 'side'
                ]
            ],
            ['name' => 'Rice milk', 'image_path' => '67bead9a4203c3fa8a93e7342d5cf73c.jpg', 'category' => [
                    'name' => 'dessert',
                    'type' => 'side'
                ]
            ],
            ['name' => 'Banana split', 'image_path' => '67bead9a4203c3fa8a93e7342d5cf73c.jpg', 'category' => [
                    'name' => 'dessert',
                    'type' => 'side'
                ]
            ],
        ];

        foreach ($dishes as $key => $item){
            $dish = factory(\App\Model\Product::class)->create([
                'name' => $dishes[$key]['name'],
                'image_path' => '/uploads/' . $dishes[$key]['image_path'],
                'restaurant_id' => $this->restaurant->id
            ]);

            $taxonomy = \App\Model\Taxonomy::where('name', '=', $item['category']['name'])
                ->where('type', '=', $item['category']['type'])
                ->first();

            if(!$taxonomy){
                $taxonomy = factory(\App\Model\Taxonomy::class)->create([
                    'name' => $item['category']['name'],
                    'type' => $item['category']['type'],
                    'restaurant_id' => $this->restaurant->id
                ]);
            }
            $dish->taxonomies()->save($taxonomy);
        }
    }
}
