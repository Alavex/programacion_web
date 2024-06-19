document.addEventListener('DOMContentLoaded', () => {
    const articleList = document.getElementById('article-list');
    const articleTitle = document.getElementById('article-title');
    const articleBody = document.getElementById('article-body');
    const articleContent = document.getElementById('article-content');
    const motivationalMessage = document.getElementById('motivational-message');
    const commentsList = document.getElementById('comments-list');
    const addCommentForm = document.getElementById('add-comment-form');
    let currentArticleId = null;

    fetch('get_data.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(article => {
                const li = document.createElement('li');
                li.textContent = article.title;
                li.addEventListener('click', () => {
                    motivationalMessage.style.display = 'none';
                    articleContent.style.display = 'block';
                    articleTitle.textContent = article.title;
                    articleBody.textContent = article.content;
                    currentArticleId = article.id;
                    loadComments(currentArticleId);
                });
                articleList.appendChild(li);
            });
        });

    addCommentForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const username = document.getElementById('username').value;
        const comment = document.getElementById('comment').value;

        fetch('add_comment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ article_id: currentArticleId, username, comment })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const li = document.createElement('li');
                li.textContent = `${username}: ${comment}`;
                commentsList.appendChild(li);
                addCommentForm.reset();
            }
        });
    });

    function loadComments(articleId) {
        commentsList.innerHTML = '';
        fetch(`get_comments.php?article_id=${articleId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(comment => {
                    const li = document.createElement('li');
                    li.textContent = `${comment.username}: ${comment.comment}`;
                    commentsList.appendChild(li);
                });
            });
    }
});