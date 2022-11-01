<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\User;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class CommentNotifications extends Component
{
    const NOTIFICATION_THRESHOLD = 10;
    public $notifications;
    public $notificationsCount;
    public $isLoading;

    protected $listeners = ['getNotifications'];

    public function mount()
    {
        $this->notifications = collect([]);
        $this->isLoading = true;
        $this->getNotificationsCount();
    }

    public function getNotificationsCount()
    {
        $this->notificationsCount = auth()->user()->unreadNotifications()->count();

        if($this->notificationsCount > self::NOTIFICATION_THRESHOLD) {
            $this->notificationsCount = self::NOTIFICATION_THRESHOLD.'+';
        }
    }

    public function getNotifications() 
    {
        $this->notifications = auth()->user()
            ->unreadNotifications()
            ->latest()
            ->take(self::NOTIFICATION_THRESHOLD)
            ->get();

        $this->isLoading = false;
    }

    public function markAsRead($notificationId) 
    {
        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $notification = DatabaseNotification::findorFail($notificationId);
        $notification->markAsRead();
        
        $this->scrollToComment($notification);
        
    }

    public function scrollToComment($notification)
    {
        $idea = Idea::find($notification->data['idea_id']);
        if (! $idea) {
            session()->flash('error_message', 'This idea no longer exists!');

            return redirect()->route('idea.index');
        }

        $comment = Comment::find($notification->data['comment_id']);
        if (! $comment) {
           session()->flash('error_message', 'This comment no longer exists!');
           
           return redirect()->route('idea.index');
            
        }

        $comments = $idea->comments()->pluck('id');
        $indexOfComment = $comments->search($comment->id);

        $page = (int) ($indexOfComment / $comment->getPerPage()) + 1;

        session()->flash('scrollToComment', $comment->id);

        return redirect()->route('idea.show', [
            'idea' => $notification->data['idea_slug'],
            'page' => $page,
        ]);

    }

    public function markAllAsRead()
    {
        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        auth()->user()->unreadNotifications->markAsRead();
        $this->getNotifications();
        $this->getNotificationsCount();
    }

    public function render()
    {
        return view('livewire.comment-notifications');
    }
}
