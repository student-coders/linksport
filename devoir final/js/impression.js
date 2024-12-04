<script>
    function printReservation(reservationId) {
        const reservationContent = document.getElementById('reservation-' + reservationId).innerHTML;

        // Créer une nouvelle fenêtre pour l'impression
        const printWindow = window.open('', '_blank', 'width=800,height=600');

        // Insérer le contenu dans la nouvelle fenêtre
        printWindow.document.write(`
            <html>
                <head>
                    <title>Impression de la Réservation</title>
                </head>
                <body>
                    ${reservationContent}
                </body>
            </html>
        `);

        // Lancer l'impression
        printWindow.document.close();
        printWindow.print();
    }
</script>
