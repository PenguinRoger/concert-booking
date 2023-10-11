function openBookingModal(concertId, concertName, ticketsData) {
    document.getElementById('bookingModalLabel').textContent = 'Book Your Ticket for ' + concertName;

    const ticketDropdown = document.getElementById('ticket_type');
    ticketDropdown.innerHTML = '';

    if (ticketsData && ticketsData.length > 0) {
        ticketsData.forEach(ticket => {
            const option = document.createElement('option');
            option.value = ticket.type;
            option.textContent = ticket.type + ' (' + ticket.price + ' บาท)';
            option.setAttribute('data-price', ticket.price);
            ticketDropdown.appendChild(option);
        });
    } else {
        // Handle the case where there are no tickets available for the concert
        const option = document.createElement('option');
        option.textContent = 'No tickets available';
        ticketDropdown.appendChild(option);
    }

    $('#bookingModal').modal('show');
}
