<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/tree.jquery/tree.jquery.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
    
        <div id="tree1"></div>
    <script>
        $(function() {
            var data = [
                {
                    label: 'node1',
                    children: [
                        { label: 'child1' },
                        { label: 'child2' }
                    ]
                },
                {
                    label: 'node2',
                    children: [
                        { label: 'child3' }
                    ]
                }
            ];

            $('#tree1').tree({
                data: data
            });
        });
    </script>