const container = document.getElementById('news-container');

function createArticle(article) {
    const articleElement = document.createElement('div');
    articleElement.classList.add('article2');

    const titleElement = document.createElement('h2');
    titleElement.textContent = article.title;

    const urlElement = document.createElement('a');
    urlElement.href = article.url;
    urlElement.textContent = article.publisher.name;
    urlElement.target = "_blank";
    urlElement.rel = "noopener noreferrer";

    const publishedDateElement = document.createElement('p');
    publishedDateElement.textContent = new Date(article.published_date).toLocaleString();

    articleElement.appendChild(titleElement);

    if (article.urlToImage) {
        const imageElement = document.createElement('img');
        imageElement.src = article.urlToImage;
        articleElement.appendChild(imageElement);
    }

    articleElement.appendChild(urlElement);
    articleElement.appendChild(publishedDateElement);

    return articleElement;
}

function renderArticles(articles) {
    articles.forEach(article => {
        container.appendChild(createArticle(article));
    });
}

async function fetchNews() {
    const url = 'https://news-api14.p.rapidapi.com/top-headlines?country=us&language=en&pageSize=10';
    const options = {
        method: 'GET',
        headers: {
            'X-RapidAPI-Key': '92f1e76985msh212aefb4eec43a6p1d45d3jsn8d3c285be976',
            'X-RapidAPI-Host': 'news-api14.p.rapidapi.com'
        }
    };

    try {
        const response = await fetch(url, options);
        const data = await response.json();
        renderArticles(data.articles);
    } catch (error) {
        console.error('Error fetching news:', error);
    }
}

fetchNews();
