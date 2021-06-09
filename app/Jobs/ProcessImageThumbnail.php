<?php

namespace App\Jobs;

use App\Image as ImageModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Image;

class ProcessImageThumbnail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $image;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ImageModel $image)
    {
        $this->image = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // access model in the queue processing
        $image             = $this->image;
        $full_image_path   = public_path($image->org_path);
        $resize_image_path = public_path('thumbs' . DIRECTORY_SEPARATOR . $image->org_path);

        if (!file_exists(public_path('thumbs/images'))) {
            mkdir(public_path('thumbs/images'));
        }

        // create image thumb for real images
        $img = Image::make($full_image_path)->resize(300, 200);

        $img->save($resize_image_path);
    }
}
