<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Auth::routes([
  'register' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'customers'], function () {
Route::get('index', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
Route::get('create/customer', [App\Http\Controllers\CustomerController::class, 'create'])->name('customer.create');
Route::post('store/customer', [App\Http\Controllers\CustomerController::class, 'store'])->name('customer.store');
Route::get('edit/customer/{id}', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customer.edit');
Route::post('update/customer/{id}', [App\Http\Controllers\CustomerController::class, 'update'])->name('customer.update');
});
// terms route
Route::get('index-term', [App\Http\Controllers\TermsController::class, 'index'])->name('term.index');
Route::get('create-term', [App\Http\Controllers\TermsController::class, 'create'])->name('term.create');
Route::post('add-term', [App\Http\Controllers\TermsController::class, 'store'])->name('term.store');
Route::get('edit-term/{id}', [App\Http\Controllers\TermsController::class, 'edit'])->name('term.edit');
Route::put('update-term', [App\Http\Controllers\TermsController::class, 'update'])->name('term.update');
Route::delete('delete-term', [App\Http\Controllers\TermsController::class, 'destroy']);

// Item Unit route
Route::get('index-unit', [App\Http\Controllers\ItemUnitController::class, 'index'])->name('item-unit.index');
Route::post('add-item-unit', [App\Http\Controllers\ItemUnitController::class, 'store'])->name('item-unit.store');
Route::get('edit-item-unit/{id}', [App\Http\Controllers\ItemUnitController::class, 'edit'])->name('item-unit.edit');
Route::put('update-item-unit', [App\Http\Controllers\ItemUnitController::class, 'update'])->name('item-unit.update');
// Item group route
Route::get('index-item-group', [App\Http\Controllers\ItemGroupController::class, 'index'])->name('item-group.index');
Route::post('add-item-group', [App\Http\Controllers\ItemGroupController::class, 'store'])->name('item-group.store');
Route::get('edit-item-group/{id}', [App\Http\Controllers\ItemGroupController::class, 'edit'])->name('item-group.edit');
Route::put('update-item-group', [App\Http\Controllers\ItemGroupController::class, 'update'])->name('item-group.update');
//item category route
Route::get('category/index', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
Route::get('create/category', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
Route::post('store/category', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
Route::get('edit/category/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
Route::post('update/category/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
Route::post('/category-child', [\App\Http\Controllers\CategoryController::class, 'getChildByParentId'])->name('category.child');

//item route
Route::get('items-index', [App\Http\Controllers\ItemsController::class, 'index'])->name('items.index');
Route::get('create/items', [App\Http\Controllers\ItemsController::class, 'create'])->name('items.create');
Route::post('store/items', [App\Http\Controllers\ItemsController::class, 'store'])->name('items.store');
Route::get('edit/items/{id}', [App\Http\Controllers\ItemsController::class, 'edit'])->name('items.edit');
Route::post('update/items/{id}', [App\Http\Controllers\ItemsController::class, 'update'])->name('items.update');
//vendor route
Route::group(['prefix' => 'vendors'], function () {
Route::get('index', [App\Http\Controllers\VendorController::class, 'index'])->name('vendor.index');
Route::get('create/vendor', [App\Http\Controllers\VendorController::class, 'create'])->name('vendor.create');
Route::post('store/vendor', [App\Http\Controllers\VendorController::class, 'store'])->name('vendor.store');
Route::get('edit/vendor/{id}', [App\Http\Controllers\VendorController::class, 'edit'])->name('vendor.edit');
Route::post('update/vendor/{id}', [App\Http\Controllers\VendorController::class, 'update'])->name('vendor.update');
});

//receive type
Route::get('receive-type-index', [App\Http\Controllers\ReceiveTypeController::class, 'index'])->name('receive.type.index');
Route::get('create-receive-type', [App\Http\Controllers\ReceiveTypeController::class, 'create'])->name('receive.type.create');
Route::post('store-receive-type', [App\Http\Controllers\ReceiveTypeController::class, 'store'])->name('receive.type.store');
Route::get('edit-receive-type/{id}', [App\Http\Controllers\ReceiveTypeController::class, 'edit'])->name('receive.type.edit');
Route::put('update-receive-type', [App\Http\Controllers\ReceiveTypeController::class, 'update'])->name('receive.type.update');
//receive master
Route::get('index/receive-master', [App\Http\Controllers\ReceiveMasterController::class, 'index'])->name('receive.master.index');
Route::get('create/receive-master', [App\Http\Controllers\ReceiveMasterController::class, 'create'])->name('receive.master.create');
Route::post('store/receive-master', [App\Http\Controllers\ReceiveMasterController::class, 'store'])->name('receive.master.store');
Route::get('edit/receive-master/{id}', [App\Http\Controllers\ReceiveMasterController::class, 'edit'])->name('receive.master.edit');
Route::post('update/receive-master/{id}', [App\Http\Controllers\ReceiveMasterController::class, 'update'])->name('receive.master.update');
Route::get('item/name/info', [App\Http\Controllers\ReceiveMasterController::class, 'itemInfo'])->name('item.name.info');
Route::post('receive/info/update',[\App\Http\Controllers\ReceiveMasterController::class,'receiveInfoUpdate'])->name('receive.info.update');
//bom master route
Route::get('index/bom-master', [App\Http\Controllers\BomMasterController::class, 'index'])->name('bom.master.index');
Route::get('create/bom-master', [App\Http\Controllers\BomMasterController::class, 'create'])->name('bom.master.create');
Route::post('store/bom-master', [App\Http\Controllers\BomMasterController::class, 'store'])->name('bom.master.store');
Route::get('edit/bom-master/{id}', [App\Http\Controllers\BomMasterController::class, 'edit'])->name('bom.master.edit');
Route::post('update/bom-master/{id}', [App\Http\Controllers\BomMasterController::class, 'update'])->name('bom.master.update');
Route::get('item/unit/name/info', [App\Http\Controllers\BomMasterController::class, 'itemUnitInfo'])->name('item.unit.name.info');
//Production master
Route::get('index/production-master', [App\Http\Controllers\ProductionMasterController::class, 'index'])->name('production.master.index');
Route::get('create/production-master', [App\Http\Controllers\ProductionMasterController::class, 'create'])->name('production.master.create');
Route::post('store/production-master', [App\Http\Controllers\ProductionMasterController::class, 'store'])->name('production.master.store');
Route::get('edit/production-master/{id}', [App\Http\Controllers\ProductionMasterController::class, 'edit'])->name('production.master.edit');
Route::post('update/production-master/{id}', [App\Http\Controllers\ProductionMasterController::class, 'update'])->name('production.master.update');
Route::get('rm/unit/name/info', [App\Http\Controllers\ProductionMasterController::class, 'rmItemInfo'])->name('rm.item.info');
Route::get('product/search', [App\Http\Controllers\ProductionMasterController::class, 'productSearch'])->name('product.search');
Route::get('product/search/item', [App\Http\Controllers\ProductionMasterController::class, 'productItemSearch'])->name('production.master.search');

//Invoice master
Route::get('index/invoice-master', [App\Http\Controllers\InvoiceMasterController::class, 'index'])->name('invoice.master.index');
Route::get('create/invoice-master', [App\Http\Controllers\InvoiceMasterController::class, 'create'])->name('invoice.master.create');
Route::post('store/invoice-master', [App\Http\Controllers\InvoiceMasterController::class, 'store'])->name('invoice.master.store');
Route::get('edit/invoice-master/{id}', [App\Http\Controllers\InvoiceMasterController::class, 'edit'])->name('invoice.master.edit');
Route::post('update/invoice-master/{id}', [App\Http\Controllers\InvoiceMasterController::class, 'update'])->name('invoice.master.update');
Route::get('view/invoice-master/{id}', [App\Http\Controllers\InvoiceMasterController::class, 'show'])->name('invoice.master.view');
Route::get('invoice/pdf/{id}',[\App\Http\Controllers\InvoiceMasterController::class,'invoicePdf'])->name('invoice.pdf');
Route::get('invoice/prnpriview/{id}',[\App\Http\Controllers\InvoiceMasterController::class,'invoicePrint'])->name('invoice.prnpriview');
Route::get('challan/print/priview/{id}',[\App\Http\Controllers\InvoiceMasterController::class,'challanPrint'])->name('challan.preview');
Route::post('invoice/info/update',[\App\Http\Controllers\InvoiceMasterController::class,'invoiceInfoUpdate'])->name('invoice.info.update');
//asset type
Route::get('index/asset-type', [App\Http\Controllers\AssetTypeController::class, 'index'])->name('asset.type.index');
Route::get('create/asset-type', [App\Http\Controllers\AssetTypeController::class, 'create'])->name('asset.type.create');
Route::post('store/asset-type', [App\Http\Controllers\AssetTypeController::class, 'store'])->name('asset.type.store');
Route::get('edit-asset-type', [App\Http\Controllers\AssetTypeController::class, 'edit'])->name('asset.type.edit');
Route::put('update-asset-type', [App\Http\Controllers\AssetTypeController::class, 'update'])->name('asset.type.update');
//asset register
Route::get('index/asset-register', [App\Http\Controllers\AssetRegisterController::class, 'index'])->name('asset.register.index');
Route::get('create/asset-register', [App\Http\Controllers\AssetRegisterController::class, 'create'])->name('asset.register.create');
Route::post('store/asset-register', [App\Http\Controllers\AssetRegisterController::class, 'store'])->name('asset.register.store');
Route::get('edit/asset-register/{id}', [App\Http\Controllers\AssetRegisterController::class, 'edit'])->name('asset.register.edit');
Route::post('update/asset-register/{id}', [App\Http\Controllers\AssetRegisterController::class, 'update'])->name('asset.register.update');
//asset Revalue
Route::get('index/asset-revalue', [App\Http\Controllers\AssetRevalueController::class, 'index'])->name('asset.revalue.index');
Route::get('create/asset-revalue', [App\Http\Controllers\AssetRevalueController::class, 'create'])->name('asset.revalue.create');
Route::post('store/asset-revalue', [App\Http\Controllers\AssetRevalueController::class, 'store'])->name('asset.revalue.store');
Route::get('edit/asset-revalue/{id}', [App\Http\Controllers\AssetRevalueController::class, 'edit'])->name('asset.revalue.edit');
Route::post('update/asset-revalue/{id}', [App\Http\Controllers\AssetRevalueController::class, 'update'])->name('asset.revalue.update');
Route::get('/asset/info', [App\Http\Controllers\AssetRevalueController::class, 'info'])->name('asset.info');
//asset Closure
Route::get('index/asset-closure', [App\Http\Controllers\AssetClosureController::class, 'index'])->name('asset.closure.index');
Route::get('create/asset-closure', [App\Http\Controllers\AssetClosureController::class, 'create'])->name('asset.closure.create');
Route::post('store/asset-closure', [App\Http\Controllers\AssetClosureController::class, 'store'])->name('asset.closure.store');
Route::get('edit/asset-closure/{id}', [App\Http\Controllers\AssetClosureController::class, 'edit'])->name('asset.closure.edit');
Route::post('update/asset-closure/{id}', [App\Http\Controllers\AssetClosureController::class, 'update'])->name('asset.closure.update');
Route::get('/asset/info', [App\Http\Controllers\AssetRevalueController::class, 'info'])->name('asset.info');
//asset deprecation
Route::get('index/asset-deprecation', [App\Http\Controllers\AssetDeprecationController::class, 'index'])->name('asset.deprecation.index');
Route::get('create/asset-deprecation', [App\Http\Controllers\AssetDeprecationController::class, 'create'])->name('asset.deprecation.create');
Route::post('store/asset-deprecation', [App\Http\Controllers\AssetDeprecationController::class, 'store'])->name('asset.deprecation.store');
Route::get('edit/asset-deprecation/{id}', [App\Http\Controllers\AssetDeprecationController::class, 'edit'])->name('asset.deprecation.edit');
Route::post('update/asset-deprecation/{id}', [App\Http\Controllers\AssetDeprecationController::class, 'update'])->name('asset.deprecation.update');
Route::get('/asset/info', [App\Http\Controllers\AssetRevalueController::class, 'info'])->name('asset.info');

//Payment Mode
Route::get('index/payment-mode', [App\Http\Controllers\PaymentModeController::class, 'index'])->name('payment.mode.index');
Route::get('create/payment-mode', [App\Http\Controllers\PaymentModeController::class, 'create'])->name('payment.mode.create');
Route::post('store/payment-mode', [App\Http\Controllers\PaymentModeController::class, 'store'])->name('payment.mode.store');
Route::get('edit/payment-mode/{id}', [App\Http\Controllers\PaymentModeController::class, 'edit'])->name('payment.mode.edit');
Route::post('update/payment-mode/{id}', [App\Http\Controllers\PaymentModeController::class, 'update'])->name('payment.mode.update');
//expences Category
Route::get('index/expences-category', [App\Http\Controllers\ExpensesCategoryController::class, 'index'])->name('expenses.category.index');
Route::get('create/expences-category', [App\Http\Controllers\ExpensesCategoryController::class, 'create'])->name('expenses.category.create');
Route::post('store/expences-category', [App\Http\Controllers\ExpensesCategoryController::class, 'store'])->name('expenses.category.store');
Route::get('edit/expences-category/{id}', [App\Http\Controllers\ExpensesCategoryController::class, 'edit'])->name('expenses.category.edit');
Route::post('update/expences-category/{id}', [App\Http\Controllers\ExpensesCategoryController::class, 'update'])->name('expenses.category.update');
//expences
Route::get('index/expenses', [App\Http\Controllers\ExpensesController::class, 'index'])->name('expenses.index');
Route::get('create/expenses', [App\Http\Controllers\ExpensesController::class, 'create'])->name('expenses.create');
Route::post('store/expenses', [App\Http\Controllers\ExpensesController::class, 'store'])->name('expenses.store');
Route::get('edit/expenses/{id}', [App\Http\Controllers\ExpensesController::class, 'edit'])->name('expenses.edit');
Route::post('update/expenses/{id}', [App\Http\Controllers\ExpensesController::class, 'update'])->name('expenses.update');

//bank name
Route::get('index/bank-name', [App\Http\Controllers\BankNameController::class, 'index'])->name('bank.name.index');
Route::get('create/bank-name', [App\Http\Controllers\BankNameController::class, 'create'])->name('bank.name.create');
Route::post('store/bank-name', [App\Http\Controllers\BankNameController::class, 'store'])->name('bank.name.store');
Route::get('edit/bank-name/{id}', [App\Http\Controllers\BankNameController::class, 'edit'])->name('bank.name.edit');
Route::post('update/bank-name/{id}', [App\Http\Controllers\BankNameController::class, 'update'])->name('bank.name.update');
//agent route
Route::get('index/agent', [App\Http\Controllers\AgentController::class, 'index'])->name('agent.index');
Route::get('create/agent', [App\Http\Controllers\AgentController::class, 'create'])->name('agent.create');
Route::post('store/agent', [App\Http\Controllers\AgentController::class, 'store'])->name('agent.store');
Route::get('edit/agent/{id}', [App\Http\Controllers\AgentController::class, 'edit'])->name('agent.edit');
Route::post('update/agent/{id}', [App\Http\Controllers\AgentController::class, 'update'])->name('agent.update');
//Customer payment route
Route::get('index/payment', [App\Http\Controllers\PaymentController::class, 'index'])->name('payment.index');
Route::get('create/payment', [App\Http\Controllers\PaymentController::class, 'create'])->name('payment.create');
Route::post('store/payment', [App\Http\Controllers\PaymentController::class, 'store'])->name('payment.store');
Route::get('edit/payment/{id}', [App\Http\Controllers\PaymentController::class, 'edit'])->name('payment.edit');
Route::post('update/payment/{id}', [App\Http\Controllers\PaymentController::class, 'update'])->name('payment.update');

//Vendor payment route
Route::get('index/vendor/payment', [App\Http\Controllers\VendorPaymentController::class, 'index'])->name('vendor.payment.index');
Route::get('create/vendor/payment', [App\Http\Controllers\VendorPaymentController::class, 'create'])->name('vendor.payment.create');
Route::post('store/vendor/payment', [App\Http\Controllers\VendorPaymentController::class, 'store'])->name('vendor.payment.store');
Route::get('edit/vendor/payment/{id}', [App\Http\Controllers\VendorPaymentController::class, 'edit'])->name('vendor.payment.edit');
Route::post('update/vendor/payment/{id}', [App\Http\Controllers\VendorPaymentController::class, 'update'])->name('vendor.payment.update');

//Gate pass route
Route::get('index/gate-pass', [App\Http\Controllers\GatePassMasterController::class, 'index'])->name('gate.pass.index');
Route::get('create/gate-pass', [App\Http\Controllers\GatePassMasterController::class, 'create'])->name('gate.pass.create');
Route::post('store/gate-pass', [App\Http\Controllers\GatePassMasterController::class, 'store'])->name('gate.pass.store');
Route::get('edit/gate-pass/{id}', [App\Http\Controllers\GatePassMasterController::class, 'edit'])->name('gate.pass.edit');
Route::post('update/gate-pass/{id}', [App\Http\Controllers\GatePassMasterController::class, 'update'])->name('gate.pass.update');
Route::post('gp/info/update',[\App\Http\Controllers\GatePassMasterController::class,'gpInfoUpdate'])->name('gp.info.update');
//Collection route
Route::get('index/collection/adjustment', [App\Http\Controllers\CollectionAdjustmentController::class, 'index'])->name('collection.adjustment.index');
Route::get('create/collection/adjustment', [App\Http\Controllers\CollectionAdjustmentController::class, 'create'])->name('collection.adjustment.create');
Route::post('store/collection/adjustment', [App\Http\Controllers\CollectionAdjustmentController::class, 'store'])->name('collection.adjustment.store');
Route::get('edit/collection/adjustment/{id}', [App\Http\Controllers\CollectionAdjustmentController::class, 'edit'])->name('collection.adjustment.edit');
Route::post('update/collection/adjustment/{id}', [App\Http\Controllers\CollectionAdjustmentController::class, 'update'])->name('collection.adjustment.update');
//Stock Adjustment route
Route::get('index/stock/adjustment', [App\Http\Controllers\StockAdjustmentController::class, 'index'])->name('stock.adjustment.index');
Route::get('create/stock/adjustment', [App\Http\Controllers\StockAdjustmentController::class, 'create'])->name('stock.adjustment.create');
Route::post('store/stock/adjustment', [App\Http\Controllers\StockAdjustmentController::class, 'store'])->name('stock.adjustment.store');
Route::get('edit/stock/adjustment/{id}', [App\Http\Controllers\StockAdjustmentController::class, 'edit'])->name('stock.adjustment.edit');
Route::post('update/stock/adjustment/{id}', [App\Http\Controllers\StockAdjustmentController::class, 'update'])->name('stock.adjustment.update');
//Bill route
Route::get('index/bill/master', [App\Http\Controllers\BillMasterController::class, 'index'])->name('bill.master.index');
Route::get('create/bill/master', [App\Http\Controllers\BillMasterController::class, 'create'])->name('bill.master.create');
Route::post('store/bill/master', [App\Http\Controllers\BillMasterController::class, 'store'])->name('bill.master.store');
Route::get('edit/bill/master/{id}', [App\Http\Controllers\BillMasterController::class, 'edit'])->name('bill.master.edit');
Route::post('update/bill/master/{id}', [App\Http\Controllers\BillMasterController::class, 'update'])->name('bill.master.update');
Route::get('bill/preview/{id}', [App\Http\Controllers\BillMasterController::class, 'billPreview'])->name('bill.preview');
Route::get('bill/master/{id}', [App\Http\Controllers\BillMasterController::class, 'billPrint'])->name('bill.print');
//Reports
// received Reports
Route::get('index/report', [App\Http\Controllers\ReportController::class, 'index'])->name('report.index');
Route::get('receive/report', [App\Http\Controllers\ReportController::class, 'receivedReport'])->name('received.report');
Route::post('receive/search', [App\Http\Controllers\ReportController::class, 'receivedSearch'])->name('received.search');
Route::get('receive/print/{parameter?}', [App\Http\Controllers\ReportController::class, 'receivedPrint'])->name('received.print');
// gate pass Reports
Route::get('gatepass/report', [App\Http\Controllers\ReportController::class, 'gatepassReport'])->name('gatepass.report');
Route::post('gatepass/search', [App\Http\Controllers\ReportController::class, 'gatepassSearch'])->name('gatepass.search');
Route::get('gate-pass/print/{parameter?}', [App\Http\Controllers\ReportController::class, 'gatePassPrint'])->name('gatePass.print');
//invoice Reports
Route::get('challan/report', [App\Http\Controllers\ReportController::class, 'challanReport'])->name('challan.report');
Route::post('challan/search', [App\Http\Controllers\ReportController::class, 'challanSearch'])->name('challan.search');
Route::get('challan/print/{parameter?}', [App\Http\Controllers\ReportController::class, 'challanPrint'])->name('challan.print');
//expenses Reports
Route::get('expenses/report', [App\Http\Controllers\ReportController::class, 'expensesReport'])->name('expenses.report');
Route::post('expenses/search', [App\Http\Controllers\ReportController::class, 'expensesSearch'])->name('expenses.search');
Route::get('expenses/print/{parameter?}', [App\Http\Controllers\ReportController::class, 'expensesPrint'])->name('expenses.print');
//Production Reports
Route::get('production/report', [App\Http\Controllers\ReportController::class, 'productionReport'])->name('production.report');
Route::post('production/search', [App\Http\Controllers\ReportController::class, 'productionSearch'])->name('production.search');
Route::get('production/print/{parameter?}', [App\Http\Controllers\ReportController::class, 'productionPrint'])->name('production.print');
//Collection Reports
Route::get('collection/report', [App\Http\Controllers\ReportController::class, 'collectionReport'])->name('collection.report');
Route::post('collection/search', [App\Http\Controllers\ReportController::class, 'collectionSearch'])->name('collection.search');
Route::get('collection/print/{parameter?}', [App\Http\Controllers\ReportController::class, 'collectionPrint'])->name('collection.print');
//Stock Reports
Route::get('stock/report', [App\Http\Controllers\ReportController::class, 'stockReport'])->name('stock.report');
Route::get('stock/print/{parameter?}', [App\Http\Controllers\ReportController::class, 'stockPrint'])->name('stock.print');
//Payment Reports
Route::get('payment/report', [App\Http\Controllers\ReportController::class, 'paymentReport'])->name('payment.report');
Route::post('payment/search', [App\Http\Controllers\ReportController::class, 'paymentSearch'])->name('payment.search');
Route::get('payment/print/{parameter?}', [App\Http\Controllers\ReportController::class, 'paymentPrint'])->name('payment.print');
