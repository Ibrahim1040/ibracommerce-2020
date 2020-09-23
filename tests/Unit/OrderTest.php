<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    // test pour créer une commande
    public function testCreateOrder()
    {
        // la variable $data va contenir l'id du produit, la quantité et l'adresse 
        $data  = [
                    'product' => 1,
                    'quantity' => 20,
                    'address' => "Avenue d'auderghem,239"
                ];
        // La variable $user va contenir un faux user. 
        $user   = factory(\App\User::class)->create();
        $response = $this->actingAs($user, 'api')->json('POST', '/api/orders',$data);
        // Je vérifie que l'objet de réponse c'est 200(ok).
        $response->assertStatus(200);
        $response->assertJson(['status'        => true]);
        $response->assertJson(['message'       => "Commande créée!"]);
        // Je vérifie que les données sont exactes.
        $response->assertJsonStructure(['data' => [
                                'id',
                                'product_id',
                                'user_id',
                                'quantity',
                                'address',
                                'created_at',
                                'updated_at'
                        ]]);
    }

    public function testGetAllOrders()
    {
        $user             = factory(\App\User::class)->create();
        $response         = $this->actingAs($user, 'api')->json('GET', '/api/orders');
        $response->assertStatus(200);
        $response->assertJsonStructure(
                [
                        [
                                'id',
                                'product_id',
                                'user_id',
                                'quantity',
                                'address',
                                'created_at',
                                'updated_at'
                        ]
                ]
            );
    }

    public function testDeliverOrder()
    {
        $user      = factory(\App\User::class)->create();
        $response  = $this->actingAs($user, 'api')->json('GET', '/api/orders');
        $response->assertStatus(200);

        $order     = $response->getData()[0];

        $update    = $this->actingAs($user, 'api')->json('PATCH', '/api/orders/'.$order->id."/deliver");
        $update->assertStatus(200);
        $update->assertJson(['message' => "Commande livrée!"]);

        $updatedOrder = $update->getData('data');
        $this->assertTrue($updatedOrder['data']['is_delivered']);
        $this->assertEquals($updatedOrder['data']['id'], $order->id);
    }

    public function testUpdateOrder()
    {   // Test la mise à jour d'une commande
        $user      = factory(\App\User::class)->create();
        $response  = $this->actingAs($user, 'api')->json('GET', '/api/orders');
        $response->assertStatus(200);
        // Je prend la première commande avec l'indice 0.
        $order     = $response->getData()[0];
        // J'essaye de modifier la quantité de la commande.
        $update    = $this->actingAs($user, 'api')->json('PATCH', '/api/orders/'.$order->id,['quantity' => ($order->id+5)]);
        // Je vérifie que ca fonctionne bien.
        $update->assertStatus(200);
        // Je vérifie aussi que le message fonctionne.
        $update->assertJson(['message' => "Commande mise à jour!"]);
    }

    public function testDeleteOrder()
    {   // Test la suppression d'une commande
        // Création d'unfaux utilisateur
        $user     = factory(\App\User::class)->create();
        $response = $this->actingAs($user, 'api')->json('GET', '/api/orders');
        $response->assertStatus(200);
        // prendre la 1 ère commande de la liste 
        $order    = $response->getData()[0];
        // Faire une requete DELETE 
        $update   = $this->actingAs($user, 'api')->json('DELETE', '/api/orders/'.$order->id);
        // Vérifier le status 200 (OK)
        $update->assertStatus(200);
        // Vérifier le message de retour
        $update->assertJson(['message' => "Commande supprimée!"]);
    }
}
