<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;

class MarkCommentAsNotSpam extends Component
{
    public Comment $comment;

    protected $listeners = ['setMarkAsNotSpamComment'];

    public function setMarkAsNotSpamComment($commentId)
    {
        $this->comment = Comment::findOrFail($commentId);

        $this->emit('markAsNotSpamCommentWasSet');
    }

    public function markAsNotSpam () 
    {
        //Authorization
        if(auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

       $this->comment->spam_reports = 0;
       $this->comment->save();

        $this->emit('commentWasMarkedAsNotSpam', 'Comment spam counter was reset!');
    }
    public function render()
    {
        return view('livewire.mark-comment-as-not-spam');
    }
}
