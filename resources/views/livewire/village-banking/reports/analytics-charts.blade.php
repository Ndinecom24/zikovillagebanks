<div>
    @push('custom-styles')
    <style>
        :root{--ac-navy:#1E3A5F;--ac-navy-light:#2B6B96;--ac-amber:#D97706;--ac-amber-light:#F59E0B;--ac-bg:#f4f6fa;--ac-card:#fff;--ac-border:#edf0f7;--ac-text:#1e293b;--ac-muted:#64748b;--ac-faint:#94a3b8;--ac-green:#16a34a;--ac-red:#dc2626;--ac-blue:#2563eb;--ac-purple:#7c3aed;--ac-cyan:#0891b2;--ac-orange:#ea580c;--ac-radius:16px;}
        .ac-page{background:var(--ac-bg);min-height:100vh;}
        .ac-hero{background:linear-gradient(135deg,var(--ac-navy) 0%,#234b78 50%,var(--ac-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .ac-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .ac-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .ac-bc{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}.ac-bc a{color:rgba(255,255,255,.55);text-decoration:none;}.ac-bc a:hover{color:rgba(255,255,255,.85);}.ac-bc .active{color:var(--ac-amber-light);font-weight:600;}.ac-bc .sep{color:rgba(255,255,255,.25);}
        .ac-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .ac-hero-title h1{color:#fff;font-size:1.6rem;font-weight:800;margin:0;}.ac-hero-title h1 i{color:var(--ac-amber);margin-right:.5rem;}
        .ac-hero-sub{color:rgba(255,255,255,.55);font-size:.88rem;margin:.25rem 0 0;}
        .ac-hero-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;border-radius:10px;font-size:.82rem;font-weight:700;text-decoration:none;transition:all .2s;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.8);}.ac-hero-btn:hover{background:rgba(255,255,255,.15);color:#fff;text-decoration:none;}
        .ac-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}
        .ac-filters{background:var(--ac-card);border-radius:var(--ac-radius);border:1px solid var(--ac-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1rem 1.5rem;margin-bottom:1.25rem;display:flex;align-items:end;gap:.75rem;flex-wrap:wrap;}
        .ac-label{display:block;font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--ac-faint);margin-bottom:.3rem;}
        .ac-select{padding:.45rem .75rem;border:1px solid var(--ac-border);border-radius:10px;font-size:.82rem;background:#fafbfd;cursor:pointer;min-width:150px;}.ac-select:focus{outline:none;border-color:var(--ac-amber);}

        .ac-card{background:var(--ac-card);border-radius:var(--ac-radius);border:1px solid var(--ac-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;margin-bottom:1rem;}
        .ac-card-header{padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem;border-bottom:1px solid var(--ac-border);}
        .ac-card-title{font-size:.95rem;font-weight:700;color:var(--ac-text);display:flex;align-items:center;gap:.4rem;}.ac-card-title i{color:var(--ac-amber);font-size:.8rem;}
        .ac-chart-body{padding:1.25rem 1.5rem;min-height:300px;}

        @keyframes acSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}.ac-animate{animation:acSlide .3s ease;}
        @media(max-width:768px){.ac-content{padding:0 .75rem 1.5rem;}}
    </style>
    @endpush

    @push('custom-scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.44.0/dist/apexcharts.min.js"></script>
    <script>
    document.addEventListener('livewire:load', function () {
        const navy = '#1E3A5F', navyLight = '#2B6B96', amber = '#D97706', green = '#16a34a',
              red = '#dc2626', blue = '#2563eb', purple = '#7c3aed', cyan = '#0891b2', orange = '#ea580c';
        const chartDefaults = { chart: { fontFamily: 'inherit', toolbar: { show: false } }, grid: { borderColor: '#edf0f7', strokeDashArray: 3 } };

        // 1) Contribution Trend — Area Chart
        const contData = @json($contributionTrend);
        if (contData.length > 0) {
            new ApexCharts(document.querySelector('#chart-contributions'), Object.assign({}, chartDefaults, {
                chart: { ...chartDefaults.chart, type: 'area', height: 280 },
                series: [{ name: 'Contributions (K)', data: contData.map(d => d.total) }],
                xaxis: { categories: contData.map(d => d.label), labels: { style: { fontSize: '10px', colors: '#94a3b8' }, rotate: -45 } },
                yaxis: { labels: { style: { fontSize: '10px', colors: '#94a3b8' }, formatter: v => 'K' + (v/1000).toFixed(1) + 'k' } },
                fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.05, stops: [0, 100] } },
                colors: [cyan], stroke: { width: 2.5, curve: 'smooth' },
                tooltip: { y: { formatter: v => 'K' + Number(v).toLocaleString() } },
                dataLabels: { enabled: false },
            })).render();
        }

        // 2) Loan Trend — Bar Chart
        const loanData = @json($loanTrend);
        if (loanData.length > 0) {
            new ApexCharts(document.querySelector('#chart-loans'), Object.assign({}, chartDefaults, {
                chart: { ...chartDefaults.chart, type: 'bar', height: 280 },
                series: [{ name: 'Loans Issued (K)', data: loanData.map(d => d.issued) }, { name: 'Count', data: loanData.map(d => d.count) }],
                xaxis: { categories: loanData.map(d => d.label), labels: { style: { fontSize: '10px', colors: '#94a3b8' }, rotate: -45 } },
                yaxis: [
                    { title: { text: 'Amount (K)' }, labels: { style: { fontSize: '10px' }, formatter: v => 'K' + (v/1000).toFixed(1) + 'k' } },
                    { opposite: true, title: { text: 'Count' }, labels: { style: { fontSize: '10px' } } }
                ],
                colors: [orange, amber], plotOptions: { bar: { borderRadius: 4, columnWidth: '55%' } },
                tooltip: { y: { formatter: (v, { seriesIndex }) => seriesIndex === 0 ? 'K' + Number(v).toLocaleString() : v } },
                dataLabels: { enabled: false },
            })).render();
        }

        // 3) Loan Status — Donut
        const statusData = @json($loanStatusDist);
        if (statusData.length > 0) {
            const statusColors = { 'Pending': amber, 'Approved': blue, 'Active': green, 'Completed': '#6b7280', 'Rejected': red };
            new ApexCharts(document.querySelector('#chart-loan-status'), {
                chart: { type: 'donut', height: 280, fontFamily: 'inherit' },
                series: statusData.map(d => d.count),
                labels: statusData.map(d => d.status),
                colors: statusData.map(d => statusColors[d.status] || '#94a3b8'),
                plotOptions: { pie: { donut: { size: '60%', labels: { show: true, total: { show: true, label: 'Total', fontSize: '12px', fontWeight: 800 } } } } },
                legend: { position: 'bottom', fontSize: '11px' },
                dataLabels: { enabled: true, style: { fontSize: '11px' } },
            }).render();
        }

        // 4) Fund Comparison — Grouped Bar
        const fundData = @json($fundComparison);
        if (fundData.length > 0) {
            new ApexCharts(document.querySelector('#chart-fund-comparison'), Object.assign({}, chartDefaults, {
                chart: { ...chartDefaults.chart, type: 'bar', height: 300 },
                series: [
                    { name: 'Contributions', data: fundData.map(d => d.contributions) },
                    { name: 'Loans', data: fundData.map(d => d.loans) },
                    { name: 'Insurance', data: fundData.map(d => d.insurance) },
                ],
                xaxis: { categories: fundData.map(d => d.circle), labels: { style: { fontSize: '11px', colors: '#94a3b8' } } },
                yaxis: { labels: { style: { fontSize: '10px' }, formatter: v => 'K' + (v/1000).toFixed(1) + 'k' } },
                colors: [cyan, orange, purple], plotOptions: { bar: { borderRadius: 4, columnWidth: '65%' } },
                tooltip: { y: { formatter: v => 'K' + Number(v).toLocaleString() } },
                dataLabels: { enabled: false },
            })).render();
        }

        // 5) Repayment vs Outstanding — Stacked Bar
        const repData = @json($repaymentVsOutstanding);
        if (repData.length > 0) {
            new ApexCharts(document.querySelector('#chart-repayment'), Object.assign({}, chartDefaults, {
                chart: { ...chartDefaults.chart, type: 'bar', height: 280, stacked: true },
                series: [
                    { name: 'Repaid', data: repData.map(d => d.repaid) },
                    { name: 'Outstanding', data: repData.map(d => d.outstanding) },
                ],
                xaxis: { categories: repData.map(d => d.circle), labels: { style: { fontSize: '11px', colors: '#94a3b8' } } },
                yaxis: { labels: { style: { fontSize: '10px' }, formatter: v => 'K' + (v/1000).toFixed(1) + 'k' } },
                colors: [green, red], plotOptions: { bar: { borderRadius: 4, horizontal: true } },
                tooltip: { y: { formatter: v => 'K' + Number(v).toLocaleString() } },
                dataLabels: { enabled: false },
            })).render();
        }

        // 6) Member Distribution — Bar
        const memData = @json($memberGrowth);
        if (memData.length > 0) {
            new ApexCharts(document.querySelector('#chart-members'), Object.assign({}, chartDefaults, {
                chart: { ...chartDefaults.chart, type: 'bar', height: 260 },
                series: [{ name: 'Members', data: memData.map(d => d.members) }],
                xaxis: { categories: memData.map(d => d.circle), labels: { style: { fontSize: '11px', colors: '#94a3b8' } } },
                yaxis: { labels: { style: { fontSize: '10px' } } },
                colors: [navy], plotOptions: { bar: { borderRadius: 6, columnWidth: '50%', distributed: true } },
                dataLabels: { enabled: true, style: { fontSize: '12px', fontWeight: 800 } },
                legend: { show: false },
            })).render();
        }
    });
    </script>
    @endpush

    @can('view-reports')
    <section class="content ac-page">
        <div class="ac-hero">
            <div class="ac-hero-inner container-fluid">
                <ul class="ac-bc">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('reports.index') }}">Reports</a></li>
                    <li class="sep">/</li>
                    <li class="active">Visual Analytics</li>
                </ul>
                <div class="ac-hero-row">
                    <div class="ac-hero-title">
                        <h1><i class="fas fa-chart-area"></i>Visual Analytics & Charts</h1>
                        <p class="ac-hero-sub">Interactive charts showing trends, distributions, and performance across all operations</p>
                    </div>
                    <a href="{{ route('reports.index') }}" class="ac-hero-btn"><i class="fas fa-arrow-left"></i> All Reports</a>
                </div>
            </div>
        </div>

        <div class="ac-content container-fluid ac-animate">
            <div class="ac-filters">
                <div><label class="ac-label">Village Bank</label>@include('partials.village-bank-selector')</div>
                <div>
                    <label class="ac-label">Circle</label>
                    <select wire:model="circleId" class="ac-select"><option value="">All Circles</option>@foreach($this->circles as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach</select>
                </div>
            </div>

            {{-- Row 1: Contribution Trend + Loan Trend --}}
            <div class="row">
                <div class="col-lg-7">
                    <div class="ac-card">
                        <div class="ac-card-header">
                            <div class="ac-card-title"><i class="fas fa-chart-area"></i> Contribution Trend</div>
                        </div>
                        <div class="ac-chart-body">
                            <div id="chart-contributions"></div>
                            @if($contributionTrend->isEmpty())
                                <div style="text-align:center;padding:2rem;color:var(--ac-faint);font-size:.85rem;"><i class="fas fa-chart-area" style="font-size:1.5rem;opacity:.15;display:block;margin-bottom:.5rem;"></i>No contribution data to chart.</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="ac-card">
                        <div class="ac-card-header">
                            <div class="ac-card-title"><i class="fas fa-chart-pie"></i> Loan Status Distribution</div>
                        </div>
                        <div class="ac-chart-body">
                            <div id="chart-loan-status"></div>
                            @if($loanStatusDist->isEmpty())
                                <div style="text-align:center;padding:2rem;color:var(--ac-faint);font-size:.85rem;"><i class="fas fa-chart-pie" style="font-size:1.5rem;opacity:.15;display:block;margin-bottom:.5rem;"></i>No loan data to chart.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Row 2: Loan Trend + Fund Comparison --}}
            <div class="row">
                <div class="col-lg-6">
                    <div class="ac-card">
                        <div class="ac-card-header">
                            <div class="ac-card-title"><i class="fas fa-chart-bar"></i> Loan Issuance Over Time</div>
                        </div>
                        <div class="ac-chart-body">
                            <div id="chart-loans"></div>
                            @if($loanTrend->isEmpty())
                                <div style="text-align:center;padding:2rem;color:var(--ac-faint);font-size:.85rem;">No loan data to chart.</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ac-card">
                        <div class="ac-card-header">
                            <div class="ac-card-title"><i class="fas fa-balance-scale"></i> Contributions vs Loans vs Insurance</div>
                        </div>
                        <div class="ac-chart-body">
                            <div id="chart-fund-comparison"></div>
                            @if($fundComparison->isEmpty())
                                <div style="text-align:center;padding:2rem;color:var(--ac-faint);font-size:.85rem;">No data to chart.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Row 3: Repayment vs Outstanding + Member Distribution --}}
            <div class="row">
                <div class="col-lg-6">
                    <div class="ac-card">
                        <div class="ac-card-header">
                            <div class="ac-card-title"><i class="fas fa-exchange-alt"></i> Repaid vs Outstanding by Circle</div>
                        </div>
                        <div class="ac-chart-body">
                            <div id="chart-repayment"></div>
                            @if($repaymentVsOutstanding->isEmpty())
                                <div style="text-align:center;padding:2rem;color:var(--ac-faint);font-size:.85rem;">No repayment data to chart.</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ac-card">
                        <div class="ac-card-header">
                            <div class="ac-card-title"><i class="fas fa-users"></i> Members per Circle</div>
                        </div>
                        <div class="ac-chart-body">
                            <div id="chart-members"></div>
                            @if($memberGrowth->isEmpty())
                                <div style="text-align:center;padding:2rem;color:var(--ac-faint);font-size:.85rem;">No member data to chart.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
