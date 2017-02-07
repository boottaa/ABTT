$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010 Q1',
            iphone: 2666,
            ipad: null,
            pc: 2647,
            android: 1432
        }, {
            period: '2010 Q2',
            iphone: 2778,
            ipad: 2294,
            pc: 2441,
            android: 1667
        }, {
            period: '2010 Q3',
            iphone: 4912,
            ipad: 1969,
            pc: 2501,
            android: 1202
        }, {
            period: '2010 Q4',
            iphone: 3767,
            ipad: 3597,
            pc: 5689,
            android: 1612
        }, {
            period: '2011 Q1',
            iphone: 6810,
            ipad: 1914,
            pc: 2293,
            android: 2412
        }, {
            period: '2011 Q2',
            iphone: 5670,
            ipad: 4293,
            pc: 1881,
            android: 4432
        }, {
            period: '2011 Q3',
            iphone: 4820,
            ipad: 3795,
            pc: 1588,
            android: 6432
        }, {
            period: '2011 Q4',
            iphone: 15073,
            ipad: 5967,
            pc: 5175,
            android: 16432
        }, {
            period: '2012 Q1',
            iphone: 10687,
            ipad: 4460,
            pc: 2028,
            android: 13432
        }, {
            period: '2012 Q2',
            iphone: 8432,
            ipad: 5713,
            pc: 1791,
            android: 10432
        }],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'pc', 'android'],
        labels: ['iPhone', 'iPad', 'PC', 'Android'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Download Sales",
            value: 12
        }, {
            label: "In-Store Sales",
            value: 30
        }, {
            label: "Mail-Order Sales",
            value: 20
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2006',
            a: 100,
            b: 90
        }, {
            y: '2007',
            a: 75,
            b: 65
        }, {
            y: '2008',
            a: 50,
            b: 40
        }, {
            y: '2009',
            a: 75,
            b: 65
        }, {
            y: '2010',
            a: 50,
            b: 40
        }, {
            y: '2011',
            a: 75,
            b: 65
        }, {
            y: '2012',
            a: 100,
            b: 90
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: 'auto',
        resize: true
    });
    
});
