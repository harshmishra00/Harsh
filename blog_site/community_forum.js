
const samplePosts = [
    {
        id: 1,
        title: "Best practices for rice cultivation in monsoon season",
        category: "crops",
        content: "I've been farming rice for 15 years and here are some tips for the upcoming monsoon season...",
        author: "Rajesh Kumar",
        date: "2024-03-15",
        likes: 24,
        comments: 8,
        isLiked: false,
        commentList: [
            { id: 1, author: "Amit Singh", content: "Great tips! I've been following similar practices.", date: "2024-03-15" },
            { id: 2, author: "Priya Patel", content: "Thanks for sharing these valuable insights.", date: "2024-03-15" }
        ]
    },
    {
        id: 2,
        title: "Weather forecast for next week - Heavy rains expected",
        category: "weather",
        content: "The meteorological department has issued a warning for heavy rainfall in our region...",
        author: "Weather Updates",
        date: "2024-03-14",
        likes: 15,
        comments: 5,
        isLiked: false,
        commentList: [
            { id: 1, author: "Rahul Sharma", content: "Thanks for the update. Will prepare accordingly.", date: "2024-03-14" }
        ]
    },
    {
        id: 3,
        title: "New pest control method for cotton crops",
        category: "pests",
        content: "I've discovered an effective organic method to control the recent pest outbreak...",
        author: "Priya Sharma",
        date: "2024-03-13",
        likes: 32,
        comments: 12,
        isLiked: false,
        commentList: [
            { id: 1, author: "Vikram Singh", content: "This method worked well for me too!", date: "2024-03-13" },
            { id: 2, author: "Anita Patel", content: "How often should we apply this solution?", date: "2024-03-13" }
        ]
    }
];

// DOM Elements
const postsContainer = document.getElementById('postsContainer');
const createPostBtn = document.getElementById('createPostBtn');
const createPostModal = document.getElementById('createPostModal');
const closeModal = document.querySelector('.close');
const postForm = document.getElementById('postForm');
const searchInput = document.getElementById('searchInput');
const categoryButtons = document.querySelectorAll('.category-btn');


const commentModal = document.createElement('div');
commentModal.id = 'commentModal';
commentModal.className = 'modal';
commentModal.innerHTML = `
    <div class="modal-content">
        <span class="close-comment">&times;</span>
        <h2>Comments</h2>
        <div class="comments-list"></div>
        <form id="commentForm">
            <div class="form-group">
                <textarea id="commentContent" placeholder="Write your comment..." required></textarea>
            </div>
            <button type="submit" class="btn-primary">Post Comment</button>
        </form>
    </div>
`;
document.body.appendChild(commentModal);

// Current filter state
let currentCategory = 'all';
let currentSearch = '';
let currentPostId = null;

// Initialize the forum
function initForum() {
    displayPosts(samplePosts);
    setupEventListeners();
}

// Display posts
function displayPosts(posts) {
    postsContainer.innerHTML = '';
    
    posts.forEach(post => {
        const postElement = createPostElement(post);
        postsContainer.appendChild(postElement);
    });
}

// Create post element
function createPostElement(post) {
    const postDiv = document.createElement('div');
    postDiv.className = 'post';
    postDiv.innerHTML = `
        <div class="post-header">
            <h3 class="post-title">${post.title}</h3>
            <span class="post-category">${post.category}</span>
        </div>
        <div class="post-content">
            <p>${post.content}</p>
        </div>
        <div class="post-footer">
            <span>Posted by ${post.author} on ${post.date}</span>
            <div class="post-actions">
                <button class="like-btn ${post.isLiked ? 'liked' : ''}" data-post-id="${post.id}">
                    <i class="fas fa-thumbs-up"></i>
                    <span class="like-count">${post.likes}</span>
                </button>
                <button class="comment-btn" data-post-id="${post.id}">
                    <i class="fas fa-comments"></i>
                    <span class="comment-count">${post.comments}</span>
                </button>
            </div>
        </div>
    `;

    // Add event listeners
    const likeBtn = postDiv.querySelector('.like-btn');
    const commentBtn = postDiv.querySelector('.comment-btn');

    likeBtn.addEventListener('click', () => handleLike(post.id));
    commentBtn.addEventListener('click', () => handleComment(post.id));

    return postDiv;
}

// Handle like action
function handleLike(postId) {
    const post = samplePosts.find(p => p.id === postId);
    if (post) {
        const likeBtn = document.querySelector(`.like-btn[data-post-id="${postId}"]`);
        const likeCount = likeBtn.querySelector('.like-count');
        
        if (post.isLiked) {
            post.likes--;
            post.isLiked = false;
            likeBtn.classList.remove('liked');
        } else {
            post.likes++;
            post.isLiked = true;
            likeBtn.classList.add('liked');
        }
        
        likeCount.textContent = post.likes;
    }
}

// Handle comment action
function handleComment(postId) {
    currentPostId = postId;
    const post = samplePosts.find(p => p.id === postId);
    if (post) {
        // Display comments
        const commentsList = commentModal.querySelector('.comments-list');
        commentsList.innerHTML = post.commentList.map(comment => `
            <div class="comment">
                <div class="comment-header">
                    <span class="comment-author">${comment.author}</span>
                    <span class="comment-date">${comment.date}</span>
                </div>
                <p class="comment-content">${comment.content}</p>
            </div>
        `).join('');

        // Show comment modal
        commentModal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
}

// Filter posts based on category and search
function filterPosts() {
    let filteredPosts = samplePosts;

    // Filter by category
    if (currentCategory !== 'all') {
        filteredPosts = filteredPosts.filter(post => post.category === currentCategory);
    }

    // Filter by search
    if (currentSearch) {
        const searchTerm = currentSearch.toLowerCase();
        filteredPosts = filteredPosts.filter(post => 
            post.title.toLowerCase().includes(searchTerm) ||
            post.content.toLowerCase().includes(searchTerm)
        );
    }

    displayPosts(filteredPosts);
}

// Setup event listeners
function setupEventListeners() {
    // Create post button
    createPostBtn.addEventListener('click', () => {
        createPostModal.style.display = 'block';
    });

    // Close modals
    closeModal.addEventListener('click', () => {
        createPostModal.style.display = 'none';
    });

    const closeCommentBtn = commentModal.querySelector('.close-comment');
    closeCommentBtn.addEventListener('click', () => {
        commentModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });

    // Close modals when clicking outside
    window.addEventListener('click', (e) => {
        if (e.target === createPostModal) {
            createPostModal.style.display = 'none';
        }
        if (e.target === commentModal) {
            commentModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });

    // Post form submission
    postForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const newPost = {
            id: samplePosts.length + 1,
            title: document.getElementById('postTitle').value,
            category: document.getElementById('postCategory').value,
            content: document.getElementById('postContent').value,
            author: "Current User",
            date: new Date().toISOString().split('T')[0],
            likes: 0,
            comments: 0,
            isLiked: false,
            commentList: []
        };

        samplePosts.unshift(newPost);
        filterPosts();
        createPostModal.style.display = 'none';
        postForm.reset();
    });

    // Comment form submission
    const commentForm = document.getElementById('commentForm');
    commentForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const post = samplePosts.find(p => p.id === currentPostId);
        if (post) {
            const commentContent = document.getElementById('commentContent').value;
            
            // Add new comment
            const newComment = {
                id: post.commentList.length + 1,
                author: "Current User",
                content: commentContent,
                date: new Date().toISOString().split('T')[0]
            };
            
            post.commentList.push(newComment);
            post.comments++;
            
            // Update comment count
            const commentBtn = document.querySelector(`.comment-btn[data-post-id="${currentPostId}"]`);
            const commentCount = commentBtn.querySelector('.comment-count');
            commentCount.textContent = post.comments;
            
            // Update comments list
            const commentsList = commentModal.querySelector('.comments-list');
            commentsList.innerHTML = post.commentList.map(comment => `
                <div class="comment">
                    <div class="comment-header">
                        <span class="comment-author">${comment.author}</span>
                        <span class="comment-date">${comment.date}</span>
                    </div>
                    <p class="comment-content">${comment.content}</p>
                </div>
            `).join('');
            
            // Clear and focus comment input
            document.getElementById('commentContent').value = '';
            document.getElementById('commentContent').focus();
        }
    });

    // Search functionality
    searchInput.addEventListener('input', (e) => {
        currentSearch = e.target.value;
        filterPosts();
    });

    // Category filtering
    categoryButtons.forEach(button => {
        button.addEventListener('click', () => {
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            currentCategory = button.dataset.category;
            filterPosts();
        });
    });
}

// Initialize the forum when the page loads
document.addEventListener('DOMContentLoaded', initForum);
