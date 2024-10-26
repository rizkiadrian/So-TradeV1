<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SaveFPFileJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $filemeta;

    /**
     * Create a new job instance.
     */
    public function __construct(object $data, array $filemeta)
    {
        //
        $this->data = $data;
        $this->filemeta = $filemeta;

    }

   
    /**
     * Execute the job.
     *
     * Saves the given JSON data to a file according to the given filemeta information.
     *
     * @return void
     */
    public function handle(): void
    {
        
        $jsonData = json_encode($this->data, JSON_PRETTY_PRINT);
        Log::info('Heavy task completed successfully.');
       
        Storage::makeDirectory($this->filemeta['file_directory']);
        Storage::put($this->filemeta['file_path'], $jsonData);
    }
}
