document.addEventListener('alpine:init', () => {
    Alpine.data('sitesData', () => ({
        sites: [],
        url: '',
        name: '',

        async loadSites() {
            try {
                const response = await fetch('/api/sites');
                this.sites = await response.json();
            } catch (error) {
                console.error('Ошибка загрузки:', error);
            }
        },

        async addSite() {
            try {
                const response = await fetch('/api/sites', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        url: this.url
                    })
                });

                if (response.ok) {
                    await this.loadSites();
                    this.url = '';
                }
            } catch (error) {
                console.error('Ошибка добавления:', error);
            }
        },
        async deleteSite(siteId) {
            if (!confirm('Вы уверены, что хотите удалить этот сайт?')) {
                return;
            }
            try {
                const response = await fetch(`/api/sites/${siteId}`, {
                    method: 'DELETE',
                });

                if (response.ok) {
                    await this.loadSites();
                }
            } catch (error) {
                console.error('Ошибка удаления:', error);
            }
        },

         copyText() {
            const text = document.querySelector('.modal-content p').textContent;
            navigator.clipboard.writeText(text)
                .then(() => alert('Текст скопирован!'))
                .catch(err => alert('Ошибка копирования: ' + err));
        },

copyCode(tracking_id, url) {
    const text = `console.log("ClickTracker running!");
class ClickTracker {
    constructor(apiUrl, siteId) {
        this.apiUrl = apiUrl;
        this.siteId = siteId;
        this.init();
    }

    init() {
        document.addEventListener('click', this.trackClick.bind(this));
    }

    trackClick(event) {
        const clickData = {
            site_tracking_id: this.siteId,
            x: event.pageX,
            y: event.pageY,
            width: window.innerWidth,
            height: window.innerHeight,
            path: window.location.pathname,
            datetime: new Date().toISOString()
        };
        console.log(clickData);
        this.sendData(clickData);
    }

    sendData(data) {
        // ссылка на api трекера (в данном случае localhost)
        fetch(\`/api/clicks\`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
            keepalive: true
        });
    }
}

// Инициализация трекера
const tracker = new ClickTracker('${url}', '${tracking_id}');`;
    
    navigator.clipboard.writeText(text)
        .then(() => alert('Код скопирован в буфер обмена!'))
        .catch(err => console.error('Ошибка копирования:', err));
    
    console.log('Копирование кода для сайта:', tracking_id, url);
},

        init() {
        this.loadSites();
    }
    }));
});