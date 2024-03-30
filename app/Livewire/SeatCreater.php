<?php

namespace App\Livewire;

use App\Models\Bus;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\Attributes\Validate; 

class SeatCreater extends Component
{
    public $bus;
    public $total_seats = 8;
    public $total_right = 2;
    public $total_left = 2;
    public $seats = [];

    public function __construct()
    {
        $this->bus = request()->route('bus');
    }

    public function mount(){
        $this->total_seats = $this->bus->total_seats;
        $this->total_right = $this->bus->total_right ?? 2;
        $this->total_left = $this->bus->total_left ?? 2;
        $this->seats = $this::generateSeatingArrangement($this->total_seats, $this->total_right, $this->total_left);
    }

    public function updated(){
        $this->bus->update([
            'total_seats' => $this->total_seats,
            'seats_left' => $this->total_left,
            'seats_right' => $this->total_right,
        ]);
        $this->seats = $this::generateSeatingArrangement($this->total_seats, $this->total_right, $this->total_left);
    }

    protected static function generateSeatingArrangement($totalSeats, $seatsInRight, $seatsInLeft) {
        $seatsInRow = intval($seatsInRight) + intval($seatsInLeft);
        $totalRows = ceil($totalSeats / $seatsInRow);

        $seats = [];
        $seatNumber = 1;

        for ($i = 0; $i < $totalRows; $i++) {
            $row = [];
    
            for ($j = 0; $j < $seatsInRow; $j++) {
                if ($seatNumber <= $totalSeats) {
                    if ($j < $seatsInLeft) {
                        $row[0][] = $seatNumber;
                    } else {
                        $row[1][] = $seatNumber;
                    }
                    $seatNumber++;
                } else {
                    break;
                }
            }

            $seats[] = $row;
        }

        return $seats;
    }

    public function render()
    {
        return view('livewire.seat-creater');
    }
}
