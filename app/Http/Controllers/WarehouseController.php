<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\Product;

class WarehouseController extends Controller
{
    public function index(Request $request)
    {

        $r_products = [
            [
                'id' => 1,
                'qty' => 30,
            ],
            [
                'id' => 2,
                'qty' => 20,
            ]
        ];

        $data = [];

        $w_house = [];

        foreach ($r_products as $r_product) {

            $items = [];

            $product = Product::find($r_product['id']);

            $product_materials = [];

            foreach ($product->materials as $p_material) {
                if (isset($product_materials[$p_material->id])) {
                    $product_materials[$p_material->id]['quantity'] += $r_product['qty'] * floatval($p_material->pivot->quantity);
                } else {
                    $product_materials[$p_material->id] = [
                        'quantity' => $r_product['qty'] * floatval($p_material->pivot->quantity),
                        'material_id' => $p_material->id,
                        'material_name' => $p_material['name']
                    ];
                }
            }

            foreach ($product_materials as $product_material) {

                $warehouses = Warehouse::query()
                    ->where('reminder', '>', 0)
                    ->where('material_id', $product_material['material_id'])
                    ->get();

                $total = $product_material['quantity'];


                foreach ($warehouses as $warehouse) {

                    if (isset($w_house[$warehouse->id])) {
                        $warehouse->reminder -= $w_house[$warehouse->id]['qty'];
                    }

                    if ($warehouse->reminder == 0) continue;

                    if ($total <= $warehouse->reminder) {

                        $items[] = [
                            'warehouse_id' => $warehouse->id,
                            'material_name' => $product_material['material_name'],
                            'qty' => (float) $total,
                            'price' => $warehouse->price
                        ];


                        if (isset($w_house[$warehouse->id])) {
                            $w_house[$warehouse->id]['qty'] += $total;
                        } else {
                            $w_house[$warehouse->id]['qty'] = $total;
                        }

                        $total = 0;

                        break;
                    }

                    $items[] = [
                        'warehouse_id' => $warehouse->id,
                        'material_name' => $product_material['material_name'],
                        'qty' => (float) $warehouse->reminder,
                        'price' => $warehouse->price
                    ];

                    if (isset($w_house[$warehouse->id])) {
                        $w_house[$warehouse->id]['qty'] += (float) $warehouse->reminder;
                    } else {
                        $w_house[$warehouse->id]['qty'] = (float) $warehouse->reminder;
                    }

                    $total -= $warehouse->reminder;
                }

                if ($total > 0) {
                    $items[] = [
                        'warehouse_id' => null,
                        'material_name' => $product_material['material_name'],
                        'qty' => (float) $total,
                        'price' => null
                    ];
                }
            }

            $data[] = [
                'product_name' => $product->name,
                'product_qty' => $r_product['qty'],
                'product_materials' => $items
            ];
        }

        return response()->json($data);

    }
}
