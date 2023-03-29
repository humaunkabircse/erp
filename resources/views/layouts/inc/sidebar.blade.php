<div id="left-sidebar" class="sidebar">
        <div class="sidebar-scroll">

            <!-- Nav tabs -->
           
            <!-- Tab panes -->
            <div class="tab-content p-l-0 p-r-0">
                <div class="tab-pane active" id="admin">
                    <nav class="sidebar-nav">
                        <ul class="main-menu metismenu">
                        <li class="active"><a href="{{route('home')}}"><i class="fa-solid fa-gauge"></i><span>Dashboard</span></a></li>
                            <li><a href="javascript:void(0);" class="has-arrow"><i class="fa-solid fa-sitemap"></i><span>Items</span> </a>
                                <ul>
                                    <li><a href="{{route('items.index')}}">Item List</a></li>
                                    <li><a href="{{route('item-unit.index')}}">Item Unit</a></li>
                                    <li><a href="{{route('item-group.index')}}">Item Group</a></li>
                                    <li><a href="{{route('category.index')}}">Item Category</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0);" class="has-arrow"><i class="fa-solid fa-handshake"></i><span>Receive</span> </a>
                                <ul>
                                    <li><a href="{{route('receive.master.index')}}">Receive List</a></li>                                      
                                    <li><a href="{{route('receive.type.index')}}">Receive Type</a></li>
 
                                </ul>
                            </li>
                            <li><a href="javascript:void(0);" class="has-arrow"><i class="fa-brands fa-product-hunt"></i><span>Production</span> </a>
                                <ul>
                                    <li><a href="{{route('production.master.index')}}">Production List</a></li>
                                    <li><a href="{{route('bom.master.index')}}">B.O.M List</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0);" class="has-arrow"><i class="fa-solid fa-truck"></i><span>Delivery</span> </a>
                                <ul>
                                    <li><a href="{{route('invoice.master.index')}}">Challan List</a></li>
                                    <li><a href="{{route('gate.pass.index')}}">Gate Pass List</a></li> 
                                </ul>
                            </li>

                            <li><a href="javascript:void(0);" class="has-arrow"><i class="fa-solid fa-coins"></i><span>Finance</span> </a>
                                <ul>   
                                    <li><a href="{{route('payment.index')}}">Collection</a></li>
                                    <li><a href="{{route('vendor.payment.index')}}">Payment</a></li>
                                    <li><a href="{{route('collection.adjustment.index')}}">Collection Adjustment</a></li> 
                                    <li><a href="{{route('expenses.index')}}">Expenses</a></li>
                                    <li><a href="{{route('expenses.category.index')}}">Expenses Category</a></li>                                    
                                    <li><a href="{{route('payment.mode.index')}}">Payment Mode</a></li>    
                                    <li><a href="{{route('bank.name.index')}}">Bank Name</a></li>                                 
                                </ul>
                            </li>

                            <li><a href="javascript:void(0);" class="has-arrow"><i class="fa-solid fa-newspaper"></i><span>Bill</span> </a>
                                <ul>   
                                <li><a href="{{route('bill.master.index')}}">BIll List</a></li>                               
                                </ul>
                            </li>

                            <li><a href="javascript:void(0);" class="has-arrow"><i class="fa-solid fa-hourglass-half"></i><span>Asset</span> </a>
                                <ul>
                                    <li><a href="{{route('asset.register.index')}}">Asset Register</a></li>
                                    <li><a href="{{route('asset.revalue.index')}}">Asset Revalue</a></li>
                                    <li><a href="{{route('asset.closure.index')}}">Asset Closure</a></li>
                                    <li><a href="{{route('asset.deprecation.index')}}">Asset Depreciation</a></li>      
                                    <li><a href="{{route('asset.type.index')}}">Asset Type</a></li>                                                       
                                </ul>
                            </li>

                            <li><a href="javascript:void(0);" class="has-arrow"><i class="fa-solid fa-globe"></i><span>Options</span> </a>
                                <ul>
                                    <li><a href="{{route('customer.index')}}">Customer</a></li>
                                    <li><a href="{{route('vendor.index')}}">Vendor</a></li>
                                    <li><a href="{{route('term.index')}}">Term</a></li> 
                                    <li><a href="{{route('stock.adjustment.index')}}">Stock Adjustment</a></li> 
                                    <li><a href="{{route('agent.index')}}">Agent</a></li>
                                </ul>
                            </li>  
                            <li><a href="{{route('report.index')}}"><i class="fa-solid fa-hotel"></i><span>Reports</span> </a>
                            </li>                        
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>