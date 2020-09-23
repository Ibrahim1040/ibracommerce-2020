<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    
    public function testCreateProductWithMiddleWare()
    {
        $data = [
                    'name' => "New Product",
                    'description' => "This is a product",
                    'units' => 20,
                    'price' => 10,
                    'image' => "https://images.pexels.com/photos/1000084/pexels-photo-1000084.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                ];

        $response = $this->json('POST', '/api/products',$data);
        $response->assertStatus(401);
        $response->assertJson(['message' => "unauthorized."]);
    }

    public function testCreateProduct()
    // ce test va créer un produit.
    {
        $data = [
                    'name' => "New Product",
                    'description' => "This is a product",
                    'units' => 20,
                    'price' => 10,
                    'image' => "https://images.pexels.com/photos/1000084/pexels-photo-1000084.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                ];
        
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user, 'api')->json('POST', '/api/products',$data);
        // Je vérifie que le test renvoi bien un status 200.
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        // je vérifie que le message de succes s'affiche bien après la création.
        $response->assertJson(['message' => "Produit créé!"]);
        $response->assertJson(['data' => $data]);
    }


    public function testGettingAllProducts()
    {
        $response = $this->json('GET', '/api/products');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                [
                        'id',
                        'name',
                        'description',
                        'units',
                        'price',
                        'image',
                        'created_at',
                        'updated_at'
                ]
            ]
        );
    }


    public function testUpdateProduct()
    {
        $response = $this->json('GET', '/api/products');
        $response->assertStatus(200);

        $product = $response->getData()[0];

        $user = factory(\App\User::class)->create();
        $update = $this->actingAs($user, 'api')->json('PATCH', '/api/products/'.$product->id,['name' => "Changed for test"]);
        $update->assertStatus(200);
        $update->assertJson(['message' => "Produit mis à jour!"]);
    }  


    public function testUploadImage()
    {
        $response = $this->json('POST', '/api/upload-file', [
            'image' => UploadedFile::fake()->image('image.jpg')
        ]);
        $response->assertStatus(201);
        $this->assertNotNull($response->getData());
    }


    public function testDeleteProduct()
    // Ici je fais un test de suppression de produit
    {
        //Obtenir tous les produits disponibles.
        $response = $this->json('GET', '/api/products');
         // Vérifier le status de réussite.
        $response->assertStatus(200);
        // Je prend le premier produit [0]
        $product = $response->getData()[0];
        //Il faut etre connecté pour pouvoir supprimer
        $user = factory(\App\User::class)->create();
        //C'est une demande en DELETE à la place de POST 
        $delete = $this->actingAs($user, 'api')->json('DELETE', '/api/products/'.$product->id);
        $delete->assertStatus(200);
        $delete->assertJson(['message' => "Produit supprimé!"]);
    }


}
