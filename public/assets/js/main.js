
   
document.addEventListener("DOMContentLoaded", function() {
$('.printModalContent').click(function(e) {
    e.preventDefault();
    let scn =        $('#scnID').val();
    let amount =       $('#amount').val();
    let yearOfCall =       $('#yearOfCall').val();
    let transaction_date =        $('#transaction_date').val();
    let transaction_id =       $('#transaction_id').val();
    let status =        $('#status').val();
    
 
      
           
            var printPageUrl = 'paymentreciept.pdf';

            var printWindow = window.open(printPageUrl, '_blank','', '', 'height=50, width=50');
            printWindow.document.open();
            printWindow.document.write(`\
            <!DOCTYPE html>\
            <html>\
            <head>\
              <title>Receipt</title>\
              <style>\
              #invoice{position: center center;  margin-top:30px;\
                box-shadow:0 0 1in -1in rgba(255, 255, 255, 0.5);\
                padding:2mm;\
                margin:0 auto;\
                margin-top: 30px !important;\
                width:80mm;\
                background-size:50mm;  background-position: center center; rgba(255, 255, 255, 0.5)}\
                background-position: center center;}\
                h3{font-size:1.2em;font-weight:300;line-height:2em;}\
                p{font-size:.12px;color:#666;line-height:1.2em;}\
                #top,#mid,#bot{border-bottom:1px solid #EEE;}\
                #top{ display: inline-block; align-items: center;}\
                #top img {\
                  width: 300px; \
                  height: auto;  \
                  align-items: center \
                  position: center center;\
                  margin-top:5px;\
                }\
                #branch{font-size:14px;   color: #009300;}\
                #mid{min-height:50px;}\
                #bot{min-height:10px;}\
                info{display:block;margin-left:0;}\
                .title{float:right;}\
                .title p{text-align:right;}\
                table{width:100%;border-collapse:collapse;opacity: 1.2;}\
                td{padding:5px 0 5px 15px;   background-color: rgba(255, 255, 255, 0.9)}\
                .tabletitle{font-size:16px;background:#EEE;}\
                .service{border-bottom:1px solid #EEE;}\
                .item{width:19mm;}\
                .tableitem{color: grey;}\
                .itemtext{font-size:12px;  color: grey; font-weight: bold;}\
                #legalcopy{margin-top:5mm;}\
                \
                #btnPrint {\
                  margin-top: 20px ;\
                  padding: 10px 20px ;\
                  background-color: green ;\
                  color: white ;\
                  font-size: 16px ;\
                  border: none;\
                }\
              }\
                @media print{  \
                  #invoice {\
                    background-repeat: no-repeat; \
                    background-size: cover; \
                    background-position: center center; \
                    background-color: rgba(255, 255, 255, 0.9); \
                  }\
                 *{-webkit-print-color-adjust: exact;}\
                  table {\
                    width: 100%; \
                    border-collapse: collapse; \
                    opacity: 1.2; \
                  }\
                  td{padding:5px 0 5px 15px !important; }\
                  #btnPrint{display:none !important;}\
                }\
              </style>\
            </head>\
            <body>\
            <div id="invoice">\
            <div id="top">\
             <center> <img id="logo" src="NBA/public/assets/home/logo-2.png" alt="NBA Logo">\
             <br/><div id="branch">Ikeja branch</div>\
             <br/><div id="tableitem">Transaction Receipt</div></center>\
            </div>\
            <div id="bot">\
              <div id="table">\
                <table id="paymentTable">\
                  <tr class="service">\
                    <td class="tableitem1"><p class="itemtext">SCN</p></td>\
                    <td class="tableitem"><p class="itemtext">${scn}</p></td>\
                  </tr>\
                  <tr class="service">\
                    <td class="tableitem1"><p class="itemtext">Year of call</p></td>\
                    <td class="tableitem"><p class="itemtext">${yearOfCall}</p></td>\
                  </tr>\
                  <tr class="service">\
                    <td class="tableitem1"><p class="itemtext">Amount</p></td>\
                    <td class="tableitem"><p class="itemtext amount"> &#8358;${amount}</p></td>\
                  </tr>\
                  <tr class="service">\
                    <td class="tableitem1"><p class="itemtext">Transaction Date</p></td>\
                    <td class="tableitem"><p class="itemtext">${transaction_date}</p></td>\
                  </tr>\
                  <tr class="service">\
                    <td class="tableitem1"><p class="itemtext">Transaction ID</p></td>\
                    <td class="tableitem"><p class="itemtext">${transaction_id}</p></td>\
                  </tr>\
                  <tr class="service">\
                    <td class="tableitem1"><p class="itemtext">Transaction Status</p></td>\
                    <td class="tableitem"><p class="itemtext">${status}</p></td>\
                  </tr>\
                </table>\
              </div>\
            </div>\
          </div>\
          <div>  <center> <button type="botton" id="btnPrint" onclick="print();">Save</button></center> </div>\
            </body>\
            </html>\
            `);
         
                printWindow.document.close();
           
                
            
   });
  
   
});

