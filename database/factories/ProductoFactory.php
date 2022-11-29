<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class ProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->city();
        return [
        'codigo'=>$this->faker->postcode(),
        'nombre'=> $name,
        'slug'=> Str::slug($name,'-'),
        'descripcion'=> $this->faker->paragraph(),
        'stock'=> 0,
        'stock_minimo' => 0,
        'precio_1' => 0,
        'precio_2' => 0,
        'precio_3' => 0
        ];
    }
}
