<?php

namespace App\Jobs;

use App\Events\ExportCompleted;
use App\Exports\BlogPostsExport;
use App\Models\Document;
use App\Notifications\BlogPostExportedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ExportBlogPostReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $filters;
    protected string $format = 'EXCEL';
    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct($user, array $filters, string $format)
    {
        $this->user = $user;
        $this->filters = $filters;
        $this->format = $format;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $filename = 'blog_posts_report_' . now()->timestamp . $this->getFileExtension($this->format);
        $path = 'users/' . $this->user->id;
        $filePath = $path . '/' . $filename;
        $document = [
            'path' => $path,
            'filename' => $filename,
            'user_id' => $this->user->id,
        ];

        Excel::store(new BlogPostsExport($this->filters), $filePath, 'local', $this->getWriterType($this->format));
        Document::create($document);

        $this->user->notify(new BlogPostExportedNotification(), ['mail', 'database']);

        ExportCompleted::dispatch($this->user, $filename);
    }

    private function getFileExtension(string $format): string
    {
        return $format === 'EXCEL' ? '.xlsx' : '.csv';
    }

    private function getWriterType(string $format): string
    {
        return $format === 'EXCEL' ? \Maatwebsite\Excel\Excel::XLSX : \Maatwebsite\Excel\Excel::CSV;
    }
}
