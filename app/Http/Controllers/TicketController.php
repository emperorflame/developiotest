<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class TicketController extends BaseController
{

    public function index(Request $request)
    {
        $tickets = $this->getTickets($request);
        return view('tickets',[
            'tickets' => $tickets
        ]);
    }

    public function getTickets (Request $request)
    {
        return Ticket::with('customer')->orderBy('due_date')->get()->toArray();
    }

    public function add(Request $request)
    {
        $request->validate([
            'ticket_name'    => 'required|min:3',
            'ticket_subject' => 'required|min:3',
            'ticket_email'   => 'required|email|min:3',
            'ticket_message' => 'required|min:10',
        ]);

        $customerData = [
            'name'  => $request->get('ticket_name'),
            'email' => $request->get('ticket_email'),
        ];

        $customerId = Customer::isCustomerExist($request->get('ticket_email'));

        if (!$customerId) {
            try {
                $customerModel = new Customer($customerData);
                $customerModel->save();
                $customerId = $customerModel->id;
            } catch (\Exception $e) {
                if (empty($customerId)) Log::error('Cannot save customer - ' . $e);
                return back()->withErrors(__('validation.default_error'));
            }
        }

        if (!is_null($customerId)) {
            $dueDate = Ticket::calculateDueDate();
            $ticketData = [
                'customer_id' => $customerId,
                'subject'     => $request->get('ticket_subject'),
                'message'     => $request->get('ticket_message'),
                'due_date'    => $dueDate,
            ];

            try {
                $ticketModel = new Ticket($ticketData);
                $ticketModel->save();
            } catch (\Exception $e) {
                Log::error("Cannot save ticket, customerId: $customerId - " . $e);
                return back()->withErrors(__('validation.default_error'));
            }

            return redirect()->back()->with('success', 'Your ticket is sent! We are going to response as soon as possible!');

        }

        return false;
    }
}
