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


        init() {
            this.loadSites();
        }
    }));
});