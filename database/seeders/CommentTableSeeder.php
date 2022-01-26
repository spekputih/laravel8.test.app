<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\BlogPost;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get all posts model from database using all()
        $posts = BlogPost::all();

        // check if there is any posts for inserting the comment into individual post.
        if($posts === 0){
            $this->command->info('There is not post, so no comments will be added');
            return;
        }

        // prompt the line in the console asking the numbers of comments that need to be generated.
        $commentsCount = (int)$this->command->ask('How many comments would you like?', 200);

        // 1. get the 'comments' collection by making the model instance using make()
        // 2. adjust the each post by using each() as it accepts closure and
        // 3. save the changes to database
        $comments = Comment::factory()->count($commentsCount)->make()->each(function($comment) use ($posts){
            $comment->blog_post_id = $posts->random()->id;
            $comment->save();
        });
    }
}
