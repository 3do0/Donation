<style>
    
    .ld-blink {
        animation: pulse 1.5s infinite ease-in-out;
    }

    @keyframes pulse {
        0% {
            opacity: 0.4; 
            transform: scale(1);
        }
        50% {
            opacity: 1;   
            transform: scale(1.05); 
        }
        100% {
            opacity: 0.4; 
            transform: scale(1); 
        }
    }

    
    .ld-fade {
        animation: fadeInOut 2s infinite ease-in-out; 
    }

    @keyframes fadeInOut {
        0% {
            opacity: 0.4; 
        }
        50% {
            opacity: 1;    
        }
        100% {
            opacity: 0.4;  
        }
    }
</style>

<div class="mt-4">
    <div class="row layout-spacing mt-5">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow border rounded">
                <div class="widget-header px-4">
                    <h4 class="font-weight-semibold ld ld-fade">جاري التحميل ..</h4>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="overflow-hidden">
                        <table class="table bg-transparent">
                            <thead>
                                <tr>
                                    @for ($j = 0; $j < 9; $j++)
                                    <th>
                                        <div class="ld ld-fade bg-dark" style="height: 18px; width: 100%; border-radius: 4px;"></div>
                                    </th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 6; $i++)
                                    <tr>
                                        @for ($j = 0; $j < 9; $j++)
                                            <td>
                                                <div class="ld ld-blink bg-light" style="height: 18px; width: 100%; border-radius: 4px;"></div>
                                            </td>
                                        @endfor
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
