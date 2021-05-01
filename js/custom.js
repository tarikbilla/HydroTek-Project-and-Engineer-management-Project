/* ============================================
===============for Update Item pge=============
===============================================*/
var qty = document.getElementById("inQTY");
var unit = document.getElementById("inUNIT");
var unitRate = document.getElementById("unitRate");
var totalKD = document.getElementById("totalKD");
var qty = document.getElementById("inQTY");
var delPer = document.getElementById("delPer");
var delivery = document.getElementById("delivery");
var insPer = document.getElementById("insPer");
var total_delivery_qty = document.getElementById("total_delivery_qty");
var rem_qty = document.getElementById("remaining_qty");
var installatin = document.getElementById("installatin");
var comPer = document.getElementById("comPer");
var commissioning = document.getElementById("commissioning");
var total_progress = document.getElementById("total_progress");
var total_invoice = document.getElementById("total_invoice");
var balance_to_be_inv = document.getElementById("balance_to_be_inv");
var balance_work = document.getElementById("balance_work");
var aa = document.getElementById("aaa");

var qtyTemp = 0;
var unitTemp = 0;
var unitRateTemp = 0;
var totalTemp = 0;



// get all value and set totalKD
function getTotalKD(){
	// totalKD.value="120";
	qtyTemp = parseFloat(qty.value);
	unitTemp = parseFloat(unit.value);
	unitRateTemp = parseFloat(unitRate.value);

	if(unitTemp>0){
		if (qtyTemp>0) {
			totalKD.value=(qtyTemp*unitTemp*unitRateTemp);
		}else{
			totalKD.value=(unitTemp*unitRateTemp);
		}
	}else{
		totalKD.value=(qtyTemp*unitRateTemp);

	}
	// called all function
	getDeliveryKD();
	getInstallatinKD();
	getCommissioningKD();
	setTotalBalanceWrk();
}

//change persent value if change totalKD
function setTotalKD(){
	getDeliveryKD();
	getInstallatinKD();
	getCommissioningKD();
	setTotalBalanceWrk();
}

availableDeliveryqty();
function availableDeliveryqty(){
	var rem_qtyTemp=parseInt(qty.value)-parseInt(total_delivery_qty.value);
	rem_qty.value=rem_qtyTemp;
	if (rem_qtyTemp<=0) {
		total_delivery_qty.value = parseInt(qty.value);
		rem_qty.value=0;
	}
	if (rem_qtyTemp>=parseInt(qty.value)) {
		total_delivery_qty.value = 0;
		rem_qty.value=parseInt(qty.value);
	}

	getDeliveryKD();
	getInstallatinKD();
	getCommissioningKD();
	setTotalBalanceWrk();
}

function getDeliveryKD(){
	totalTemp = (parseFloat(totalKD.value)/parseInt(qty.value)*parseInt(total_delivery_qty.value))/100;
	delivery.value=totalTemp*parseFloat(delPer.value);
	setTotalProgress();
	setTotalInvoice();
	setTotalBalance();
	setTotalBalanceWrk();
}
function getInstallatinKD(){
	totalTemp = (parseFloat(totalKD.value)/parseInt(qty.value)*parseInt(total_delivery_qty.value))/100;
	installatin.value=totalTemp*parseFloat(insPer.value);
	setTotalProgress();
	setTotalInvoice();
	setTotalBalance();
	setTotalBalanceWrk();
}
function getCommissioningKD(){
	totalTemp = (parseFloat(totalKD.value)/parseInt(qty.value)*parseInt(total_delivery_qty.value))/100;
	commissioning.value=totalTemp*parseFloat(comPer.value);
	setTotalProgress();
	setTotalBalance();
	setTotalBalanceWrk();
}

//total progress
function setTotalProgress(){
	var temp = parseFloat(delivery.value)+parseFloat(installatin.value)+parseFloat(commissioning.value);
	total_progress.value=temp.toFixed(3);
	setTotalBalanceWrk();
}

function setTotalInvoice(){
	var temp = parseFloat(delivery.value)+parseFloat(installatin.value);
	total_invoice.value=temp.toFixed(3);
}

function setTotalBalance(){
	var temp = parseFloat(total_progress.value)-parseFloat(total_invoice.value);
	balance_to_be_inv.value=temp.toFixed(3);
}

function setTotalBalanceWrk(){
	var temp = parseFloat(totalKD.value)-parseFloat(total_progress.value);
	balance_work.value=temp.toFixed(3);
}