<?= view('Components/Header', ['page_title' => "Search Page"]) ?>
<?= view('Components/Navbar') ?>
<div style="margin-left: 3%;">
    <h1><?= session()->user['name'] ?>, Welcome to Search Page</h1>
</div>

<div class="container mt-5">
    <h1 class="text-center">Pixabay Search</h1>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search for images or videos" id="searchInput">
        <button class="btn btn-primary" id="searchButton">Search</button>
    </div>
    <div id="results" class="row"></div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    document.getElementById('searchButton').addEventListener('click', function() {
    const query = document.getElementById('searchInput').value;
    if (query) {
        fetch(`https://pixabay.com/api/?key=44895432-bd5467b7472a8f97cb358cca0&q=${encodeURIComponent(query)}&image_type=photo&video_type=film`)
            .then(response => response.json())
            .then(data => {
                const resultsContainer = document.getElementById('results');
                resultsContainer.innerHTML = ''; // Clear previous results

                if (data.hits && data.hits.length > 0) {
                    console.log(data.hits.length);
                    data.hits.forEach(hit => {
                        const col = document.createElement('div');
                        col.className = 'col-md-4 mb-3';

                        const card = document.createElement('div');
                        card.className = 'card';

                        if (hit.type === 'photo') {
                            const img = document.createElement('img');
                            img.src = hit.previewURL;
                            img.className = 'card-img-top';
                            card.appendChild(img);
                        } else if (hit.type === 'video') {
                            const video = document.createElement('video');
                            video.src = hit.videos.tiny.url;
                            video.controls = true;
                            video.className = 'card-img-top';
                            card.appendChild(video);
                        }

                        const cardBody = document.createElement('div');
                        cardBody.className = 'card-body';
                        cardBody.innerHTML = `
                            <h5 class="card-title">${hit.tags}</h5>
                            <p class="card-text">Likes: ${hit.likes}, Views: ${hit.views}</p>
                        `;
                        card.appendChild(cardBody);
                        col.appendChild(card);
                        resultsContainer.appendChild(col);
                    });
                } else {
                    resultsContainer.innerHTML = '<p class="text-center">No results found.</p>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while fetching the data.');
            });
    } else {
        alert('Please enter a search query.');
    }
});


</script>


<?= view('Components/Footer') ?>