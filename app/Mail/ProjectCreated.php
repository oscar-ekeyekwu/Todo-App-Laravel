<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectCreated extends Mailable
{
    use Queueable, SerializesModels;
    public $project = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $project)
    {

        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.project-created')->with([
            'projectTitle' => $this->project['title'],
            'projectDescription' => $this->project['description'],
            'department' => $this->project['dept_name']
        ]);
    }
}
