<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\RowOfSeatModel;
use App\Models\admin\SeatModel;
use App\Http\Resources\SeatResource;

class SeatController extends Controller
{

    private $seat;
    private $rowOfSeat;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $this -> seat = new SeatModel();
        $this -> rowOfSeat = new RowOfSeatModel();
        $seats = [];
        $dataRowOfSeat = $this -> rowOfSeat -> selectRowOfSeatByShowtime($id);
        foreach($dataRowOfSeat as $rowOfSeat){
            $listSeat = $this -> seat -> selectSeatByRowOfSeat($rowOfSeat->row_of_seat_Id);
            foreach($listSeat as $seat){
                $seats[] = $seat;
            }
        }

        return new SeatResource($seats);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
