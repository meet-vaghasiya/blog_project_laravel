@forelse ($comments as $comment)
    <p>{{ $comment->content }}
        {{-- @updated(['date'=>$comment->created_at])
        @endupdated --}}
        @tags(['tags'=>$comment->tags])

        @endtags
        @updated(['date'=>$comment->created_at,'name'=>$comment->user->name,'userId'=>$comment->user->id])
        @endupdated
    </p>
@empty
    <p> No comments found </p>
@endforelse
