/* global html2pdf */

function toPdf() {
    const invoice = this.document.getElementById("infosProjet");
    const opt = {
        margin: 10,
        filename: 'Projet.pdf',
         jsPDF: { unit: 'mm', format:'A4', orientation: 'landscape' }
    };
    console.log(invoice);
    html2pdf().set(opt).from(invoice).save();
}