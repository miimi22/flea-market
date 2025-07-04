@extends('layouts.app')

@section('title')
<title>取引チャット画面</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/trading.css') }}" />
@endsection

@section('content')
<div class="page-container">
    <aside class="sidebar">
        <h2>その他の取引</h2>
        <div class="other-trades-list">
            @if(isset($other_trading_items) && $other_trading_items->isNotEmpty())
                @foreach($other_trading_items as $other_item)
                    <a href="{{ route('trading.show', ['item_id' => $other_item->id]) }}" class="other-trade-link">
                        {{ $other_item->product_name }}
                    </a>
                @endforeach
            @else
                <p class="no-other-trades">他に取引中の商品はありません。</p>
            @endif
        </div>
    </aside>
    <main class="transaction-container">
        <header class="transaction-header">
            <div class="header-left-group">
                <img class="image" src="{{ asset($partner->profile->profile_image ?? 'images/default.png') }}" width="80" height="80" style="border-radius: 50%;">
                <h1>「{{ $partner->name }}」さんとの取引画面</h1>
            </div>
            @if($isBuyer && !$buyerHasRated)
                <button class="complete-btn">取引を完了する</button>
            @endif
        </header>
        <hr class="separator">
        <section class="item-info">
            <img src="{{ asset($item->product_image) }}" alt="{{ $item->product_name }}の画像" class="item-image">
            <div class="item-details">
                <p class="item-name">{{ $item->product_name }}</p>
                <p class="item-price">¥{{ number_format($item->product_price) }}</p>
            </div>
        </section>
        <hr class="separator">
        <div class="message-area">
            @foreach($comments as $comment)
                @if($comment->user_id === Auth::id())
                    <div class="message-bubble current-user">
                        <div class="message-header">
                            <img src="{{ asset($comment->user->profile->profile_image ?? 'images/default.png') }}" alt="" class="avatar-image">
                            <p class="user-name">{{ $comment->user->name }}</p>
                        </div>
                        <div class="message-body">
                            <div class="message-text" id="comment-text-{{ $comment->id }}">
                                @if($comment->comment)
                                    <p>{{ $comment->comment }}</p>
                                @endif
                            </div>
                            @if($comment->trading_image)
                                <div class="message-image-container">
                                    <a href="{{ asset($comment->trading_image) }}" target="_blank">
                                        <img src="{{ asset($comment->trading_image) }}" alt="投稿画像" class="message-image">
                                    </a>
                                </div>
                            @endif
                            <form action="{{ route('trading.comment.update', $comment) }}" method="POST" class="comment-edit-form" id="comment-edit-form-{{ $comment->id }}" style="display: none;">
                                @csrf
                                @method('PATCH')
                                <input type="text" name="comment" value="{{ $comment->comment }}" required>
                                <div class="edit-form-actions">
                                    <button type="submit" class="save-btn">保存</button>
                                    <button type="button" class="cancel-edit-btn" data-comment-id="{{ $comment->id }}">キャンセル</button>
                                </div>
                            </form>
                            <div class="message-actions">
                                <a href="#" class="edit-link js-edit-comment-button" data-comment-id="{{ $comment->id }}">編集</a>
                                <form action="{{ route('trading.comment.destroy', ['comment' => $comment->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-link">削除</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="message-bubble other-user">
                        <div class="message-header">
                            <img src="{{ asset($comment->user->profile->profile_image ?? 'images/default.png') }}" alt="" class="avatar-image">
                            <p class="user-name">{{ $comment->user->name }}</p>
                        </div>
                        <div class="message-body">
                            <div class="message-text">
                                <p>{{ $comment->comment }}</p>
                            </div>
                            @if($comment->trading_image)
                                <div class="message-image-container">
                                    <a href="{{ asset($comment->trading_image) }}" target="_blank">
                                        <img src="{{ asset($comment->trading_image) }}" alt="投稿画像" class="message-image">
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <footer class="message-form-container">
            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color: red;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div id="image-preview-container" class="image-preview-container"></div>
            <form class="message-form" action="{{ route('trading.comment.store', ['item_id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="trading_image" id="trading_image_input" style="display: none;" accept="image/*">
                <input type="text" name="comment" class="comment" id="comment-input" placeholder="取引メッセージを記入してください">
                <button type="button" class="add-image-btn" id="add-image-button">画像を追加</button>
                <button type="submit" class="send-btn">
                    <img src="{{asset('images/send-btn.jpg')}}" alt="送信" width="65" height="55">
                </button>
            </form>
    </main>
</div>
<div id="rating-modal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <form action="{{ route('trading.rating.store', ['item_id' => $item->id]) }}" method="POST">
            @csrf
            <h2>取引が完了しました。</h2>
            <div class="border"></div>
            <p class="rating-question">今回の取引相手はどうでしたか？</p>
            
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5" required><label for="star5">★</label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
            </div>
            <div class="border"></div>
            <div class="submit-button-container">
                <button type="submit" class="submit-rating-btn">送信する</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const completeBtn = document.querySelector('.complete-btn');
    const ratingModal = document.getElementById('rating-modal');
    const commentInput = document.getElementById('comment-input');
    const messageForm = document.querySelector('.message-form');
    const addImageBtn = document.getElementById('add-image-button');
    const imageInput = document.getElementById('trading_image_input');
    const previewContainer = document.getElementById('image-preview-container');


    if (ratingModal) {
        @if(isset($isSeller) && $isSeller && $buyerHasRated && !$sellerHasRated)
            ratingModal.style.display = 'flex';
        @endif

        if (completeBtn) {
            completeBtn.addEventListener('click', () => {
                ratingModal.style.display = 'flex';
            });
        }

        ratingModal.addEventListener('click', (event) => {
            if (event.target === ratingModal) {
                ratingModal.style.display = 'none';
            }
        });
    }

    if (commentInput && messageForm) {
        const itemId = {{ $item->id }};
        const storageKey = `trading_draft_${itemId}`;

        const savedDraft = sessionStorage.getItem(storageKey);
        if (savedDraft) {
            commentInput.value = savedDraft;
        }

        commentInput.addEventListener('input', () => {
            sessionStorage.setItem(storageKey, commentInput.value);
        });

        messageForm.addEventListener('submit', () => {
            sessionStorage.removeItem(storageKey);
        });
    }

    if (addImageBtn && imageInput) {
        addImageBtn.addEventListener('click', () => {
            imageInput.click();
        });

        imageInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (!file) {
                if (previewContainer) previewContainer.innerHTML = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = (e) => {
                if(previewContainer) {
                    previewContainer.innerHTML = '';
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100px';
                    img.style.maxHeight = '100px';
                    previewContainer.appendChild(img);
                }
            };
            reader.readAsDataURL(file);
        });
    }

    const toggleEditMode = (commentId, showEditForm) => {
        const textDiv = document.getElementById(`comment-text-${commentId}`);
        const form = document.getElementById(`comment-edit-form-${commentId}`);
        if(textDiv && form) {
            if (showEditForm) {
                textDiv.style.display = 'none';
                form.style.display = 'block';
                form.querySelector('input[name="comment"]').focus();
            } else {
                textDiv.style.display = 'block';
                form.style.display = 'none';
            }
        }
    };

    document.querySelectorAll('.js-edit-comment-button, .cancel-edit-btn').forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const commentId = event.target.dataset.commentId;
            const isCancel = event.target.classList.contains('cancel-edit-btn');
            toggleEditMode(commentId, !isCancel);
        });
    });

    document.querySelectorAll('.comment-edit-form').forEach(form => {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            const commentId = form.id.split('-').pop();
            try {
                const response = await fetch(form.action, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        comment: form.querySelector('input[name="comment"]').value
                    })
                });
                const data = await response.json();
                if (!response.ok) {
                    throw new Error(data.message || '更新に失敗しました。');
                }
                const textParagraph = document.querySelector(`#comment-text-${commentId} p`);
                if (textParagraph) {
                    textParagraph.textContent = data.comment;
                }
                toggleEditMode(commentId, false);
            } catch (error) {
                console.error('Error:', error);
                alert(error.message);
            }
        });
    });

});
</script>
@endsection