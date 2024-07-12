let pos_script = function(){

    this.orderItems = {};
    this.totalOrderAmount = 0.00;

    this.products = products;
    this.showClock = function(){
        let dateObj = new Date;
        let months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    
        let year = dateObj.getFullYear();
        let monthNum = dateObj.getMonth();
        let dateCal = dateObj.getDate();
        let hour = dateObj.getHours();
        let min = dateObj.getMinutes();
        let sec = dateObj.getSeconds();
    
        let timeFormatted = loadScript.toTwelveHourFormat(hour);
    
        document.querySelector('.timeAndDate').innerHTML = months[monthNum] + ' ' + dateCal +', ' + year + '    ' + timeFormatted['time'] + ':' + min + ':' + sec + ' ' + timeFormatted['am_pm'];
    
        setInterval(loadScript.showClock,1000);
    }
    
    this.toTwelveHourFormat = function(time){
        let am_pm = 'AM'
        if(time > 12){
            time = time - 12;
            am_pm = 'PM';
        } 
    
        return{
            time: time,
            am_pm: am_pm
        };
    }

    this.registerEvents = function(){
        document.addEventListener('click', function(e){
            let targetEl = e.target;
            let targetElClassList = targetEl.classList;

            let addToOrderClasses = ['productImage','productName','productPrice'];

            if(targetElClassList.contains('productImage')||targetElClassList.contains('productName')||targetElClassList.contains('productPrice')){
                
                let productContainer = targetEl.closest('div.productColContainer');
                let pid = productContainer.dataset.pid;
                let productInfo = loadScript.products[pid];
                let curStock = productInfo['stock'];

                if(curStock===0){ 
                    loadScript.dialogError('Product selected is currently out of stock.');
                    
                }

                let dialogForm = '\
                    <h6 class="dialogProductName">'+ productInfo['name'] +' <span class="floatRight">P'+ productInfo['price'] +'</span></h6>\
                    <input type="number" id="orderQty" class="form-control" placeholder="Enter quantity..." min="1" />\
                ';

                BootstrapDialog.confirm({
                    title: 'Add to Order',
                    type: BootstrapDialog.TYPE_DEFAULT,
                    message: dialogForm,
                    callback: function(addOrder){
                        if(addOrder){
                            let orderQty = parseInt(document.getElementById('orderQty').value);

                            if(isNaN(orderQty)){
                                
                                loadScript.dialogError('Please type order quantity.');
                        
                            }

                            if(orderQty > curStock){

                                loadScript.dialogError('Quantity is higher than current stock. <strong>('+ curStock +')</strong>');
                                
                            }

                            loadScript.addToOrder(productInfo, pid, orderQty);
                        }
                    }
                });

            }

            if(targetElClassList.contains('deleteOrderItem')){
                let pid = targetEl.dataset.id;
                let productInfo = loadScript.orderItems[pid];

                BootstrapDialog.confirm({
                    type: BootstrapDialog.TYPE_DANGER,
                    title: '<strong>Delete Order Item</strong>',
                    message: 'Are you sure to delete <strong>'+ productInfo['name'] +'</strong>?',
                    callback: function(toDelete){
                        if(toDelete){
                            let orderedQuantity = productInfo['orderQty'];
                            loadScript.products[pid]['stock'] += orderedQuantity;

                            delete loadScript.orderItems[pid];

                            loadScript.updateOrderItemTable();
                        }
                    }
                });
            }

            if(targetElClassList.contains('quantityUpdateBtn_minus')){
                let pid = targetEl.dataset.id;

                loadScript.products[pid]['stock']++;

                loadScript.orderItems[pid]['orderQty']--;

                loadScript.orderItems[pid]['amount'] = loadScript.orderItems[pid]['orderQty'] * loadScript.orderItems[pid]['price'];

                if(loadScript.orderItems[pid]['orderQty'] === 0) delete loadScript.orderItems[pid];
                
                loadScript.updateOrderItemTable();
            }

            if(targetElClassList.contains('quantityUpdateBtn_plus')){
                let pid = targetEl.dataset.id;

                if(loadScript.products[pid]['stock'] === 0) loadScript.dialogError('Product is out of stock.');
                else{

                    loadScript.products[pid]['stock']--;

                    loadScript.orderItems[pid]['orderQty']++;

                    loadScript.orderItems[pid]['amount'] = loadScript.orderItems[pid]['orderQty'] * loadScript.orderItems[pid]['price'];
                    
                    loadScript.updateOrderItemTable();
                    
                }

            }
        });
    }

    this.updateOrderItemTable = function(){
        loadScript.totalOrderAmount = 0.00;

        let ordersContainer = document.querySelector('.pos_items');
        let html = '<p class="itemNoData">No data</p>';

        if(Object.keys(loadScript.orderItems)){

            let tableHtml = `
            <table class="table" id="pos_items_tbl">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>PRODUCT</th>
                        <th>PRICE</th>
                        <th>QTY</th>
                        <th>AMOUNT</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>__ROWS__</tbody>
            </table>`;

            let rows = '';
            let rowNum = 1;
            for (const [pid, orderItems] of Object.entries(loadScript.orderItems)){
                rows += `
                    <tr>
                        <td>${rowNum}</td>
                        <td>${orderItems['name']}</td>
                        <td>P${ loadScript.addCommas(orderItems['price']) }</td>
                        <td>
                            <a href="javascript:void(0)" data-id="${pid}" class:"quantityUpdateBtn quantityUpdateBtn_minus">
                                <i class="fa fa-minus quantityUpdateBtn quantityUpdateBtn_minus" data-id="${pid}"></i>
                            </a>
                            ${ loadScript.addCommas(orderItems['orderQty']) }
                            <a href="javascript:void(0)" data-id="${pid}" class:"quantityUpdateBtn quantityUpdateBtn_plus">
                                <i class="fa fa-plus quantityUpdateBtn quantityUpdateBtn_plus" data-id="${pid}"></i>
                            </a>
                        </td>
                        <td>P${ loadScript.addCommas(orderItems['amount'].toFixed(2)) }</td>
                        <td>
                            <a href="javascript:void(0)"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" class="deleteOrderItem" data-id="${pid}">
                                <i class="fa fa-trash deleteOrderItem" data-id="${pid}"></i>
                            </a>
                        </td>
                    </tr> 
                `;

                rowNum++;

                loadScript.totalOrderAmount += orderItems['amount'];
            }
            html = tableHtml.replace('__ROWS__', rows);
        } 

        ordersContainer.innerHTML = html;

        loadScript.updateTotalOrderAmount();
    }

    this.updateTotalOrderAmount = function(){
        document.querySelector('.item_total--value').innerHTML = 'P' + loadScript.addCommas(loadScript.totalOrderAmount.toFixed(2));
    }

    this.formatNum = function(num){
        if( isNaN(num) || num === undefined) num = 0.00;
        return num.toString().replace(/\8(?=(\d{3})+(?!\d))/g, ",");
    }

    this.addCommas = function(nStr){
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

    this.addToOrder = function(productInfo, pid, orderQty){
        //adds to order list table

        let curItemIds = Object.keys(loadScript.orderItems);
        let totalAmount = productInfo['price'] * orderQty;


        if(curItemIds.indexOf(pid) > -1){

            loadScript.orderItems[pid]['amount'] += totalAmount;
            loadScript.orderItems[pid]['orderQty'] += orderQty;

        } else {

            loadScript.orderItems[pid] = {
                name: productInfo['name'],
                price: productInfo['price'],
                orderQty: orderQty,
                amount: totalAmount
            };

        }
        loadScript.products[pid]['stock'] -= orderQty;
        
        this.updateOrderItemTable();

    }

    this.dialogError = function(message){
        BootstrapDialog.alert({
            title: '<strong>ERROR</strong>',
            type: BootstrapDialog.TYPE_DANGER,
            message: message
        });
    }

    this.initialize = function(){
        this.showClock();
        this.registerEvents();
    }
};

let loadScript = new pos_script;
loadScript.initialize();