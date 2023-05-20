<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use App\Events\ChatMessageSent;
use App\Models\ChatMessage;
use Livewire\Component;
use App\Models\User;

class Chat extends Component
{
    public $message;
    public $selectedUser;
    
    protected $listeners = ['ListenDataMensaje'];

    public function ListenDataMensaje($data)
    {

        $messages = ChatMessage::with('sender')->get();      
        // Limpiar el campo de mensaje después de enviar
        $this->message = '';
    }

    public function mount()
    {
        $this->dispatchBrowserEvent('chatMessageReceived', ['message' => $this->message]);
    }
    
    public function updatedMessage()
    {
        $this->dispatchBrowserEvent('chatMessageReceived', ['message' => $this->message]);
    }

    public function sendMessage()
    {
        // Crea una nueva instancia de ChatMessage y asigna el mensaje y otros datos necesarios
        $chatMessage = new ChatMessage();
        $chatMessage->message = $this->message;
        $chatMessage->sender_id = Auth::id();
        $chatMessage->receiver_id = $this->selectedUser;
        // Asigna otros atributos según tus necesidades

        // Guarda el mensaje en la base de datos
        $chatMessage->save();

        // Emitir el evento ChatMessageSent con la instancia de ChatMessage
        event(new ChatMessageSent($chatMessage));

        // Limpiar el campo de mensaje después de enviar
        $this->message = '';
    }
    
    public function render()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $messages = [];
    
        if ($this->selectedUser) {
            $messages = ChatMessage::with('sender')
                ->where(function ($query) {
                    $query->where('sender_id', Auth::id())
                        ->where('receiver_id', $this->selectedUser);
                })
                ->orWhere(function ($query) {
                    $query->where('sender_id', $this->selectedUser)
                        ->where('receiver_id', Auth::id());
                })
                ->get();
        }
    
        return view('livewire.chat', [
            'messages' => $messages,
            'users' => $users,
        ]);
    }
}

