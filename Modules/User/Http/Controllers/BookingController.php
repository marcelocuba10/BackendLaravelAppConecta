<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Booking;
use Modules\User\Entities\Ground;
use Modules\User\Entities\User;

class BookingController extends Controller
{

    public static $days;
    public static $schedules;

    public function __construct()
    {
        self::$days = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo");
        self::$schedules = array("12:00", "14:00", "16:00", "18:00", "20:00", "22:00", "00:00");
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $bookings = Booking::paginate(5);
        return view('user::bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $days = self::$days;
        $schedules = self::$schedules;

        $user = auth()->user();

        $customers  = User::all();
        $grounds = Ground::all();

        return view('user::bookings.create', compact('schedules', 'days', 'user','customers','grounds'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'ground_id' => 'required',
            'appointment' => 'required',
        ]);

        $request->day = json_encode($request->get('day'));
        $request->schedule = json_encode($request->get('schedule'));

        Booking::create($request->all());

        return redirect()->to('/user/bookings')->with('message', 'Reserva creada correctamente');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('user::bookings.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $booking = Booking::find($id);

        $days_selected = $booking->day;
        $schedules_selected = $booking->schedule;

        $days = self::$days;
        $schedules = self::$schedules;

        return view('user::bookings.edit', compact('booking', 'schedules', 'days', 'days_selected', 'schedules_selected'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Booking $booking)
    {

        $request->validate([
            'ground_id' => 'required',
            'appointment' => 'required',
        ]);

        $request->day = json_encode($request->get('day'));
        $request->schedule = json_encode($request->get('schedule'));

        $booking->update($request->all());

        return redirect()->to('/user/bookings')->with('message', 'Reserva actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $booking = Booking::find($id);

        $booking->delete();

        return redirect()->to('/user/bookings')->with('message', 'Reserva eliminada correctamente');
    }
}
