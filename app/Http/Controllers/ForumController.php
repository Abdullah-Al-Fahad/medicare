<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        $query = Post::with('user', 'comments.user')->latest();

        if ($category) {
            $query->where('category', $category);
        }

        $posts = $query->get();

        $sections = ['Cardiology', 'General', 'Dermatology']; // Example sections

        return view('patient.forum', compact('posts', 'category', 'sections'));
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'postContent' => 'required|max:255',
            'postImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = new Post();
        $post->content = $request->postContent;
        $post->user_id = auth()->user()->id;
        $post->category = $request->category;

        if ($request->hasFile('postImage')) {
            $image = $request->file('postImage');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            $post->image = $imageName;
        }

        $post->save();

        return redirect()->route('forum.index')->with('success', 'Post created successfully.');
    }

    public function addComment(Request $request, $postId)
    {
        $request->validate([
            'commentContent' => 'required|max:255',
        ]);

        $comment = new Comment();
        $comment->post_id = $postId;
        $comment->content = $request->commentContent;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return redirect()->route('forum.index')->with('success', 'Comment added successfully.');
    }

    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);

        // Check if the logged-in user is the owner of the post
        if ($post->user_id != auth()->user()->id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this post.');
        }

        // Delete the post's image from storage if it exists
        if ($post->image) {
            Storage::delete('public/images/' . $post->image);
        }

        // Delete the post and its associated comments
        $post->comments()->delete();
        $post->delete();

        return redirect()->route('forum.index')->with('success', 'Post deleted successfully.');
    }
}
