document.addEventListener("DOMContentLoaded", function() {
    const toursContainer = document.getElementById("tours");
    const tourCapacity = 15;
    const tours = [];

    // 3 tane tur ekleyelim
    for (let i = 1; i <= 3; i++) {
        const tour = {
            id: i,
            participants: [],
            isFull: function() {
                return this.participants.length >= tourCapacity;
            },
            addParticipant: function(name) {
                if (!this.isFull()) {
                    this.participants.push(name);
                    this.updateUI();
                } else {
                    alert("Bu tur dolu!");
                }
            },
            updateUI: function() {
                const tourElement = document.getElementById(`tour-${this.id}`);
                tourElement.textContent = `Tur ${this.id} (${this.participants.length}/${tourCapacity})`;
                tourElement.className = this.isFull() ? "tour full" : "tour available";
            }
        };
        tours.push(tour);
    }

    // Tur butonlarını oluştur
    tours.forEach(tour => {
        const tourElement = document.createElement("div");
        tourElement.id = `tour-${tour.id}`;
        tourElement.className = tour.isFull() ? "tour full" : "tour available";
        tourElement.textContent = `Tur ${tour.id} (${tour.participants.length}/${tourCapacity})`;
        tourElement.addEventListener("click", function() {
            const participantName = prompt("İsminizi girin:");
            if (participantName) {
                tour.addParticipant(participantName);
            }
        });
        toursContainer.appendChild(tourElement);
    });
});
