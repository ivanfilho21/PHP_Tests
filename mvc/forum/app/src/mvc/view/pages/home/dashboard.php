<section>
    <h2>Categories</h2>

    <a href="<?php echo URL; ?>home/dashboard/category/create" class="modal-option">Adicionar Categoria</a>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($categories as $cat): ?>
            <tr>
                <td><?php echo $cat->getId(); ?></td>
                <td><?php echo $cat->getName(); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div id="modal-bg">
        <a id="close-modal" href="#">x</a>

        <div id="modal">
            <p style="text-align: center; margin-top: 3em;">Loading...</p>
        </div>
    </div>

    <style>
        #modal-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 99;
            background: rgba(0, 0, 0, 0.6);

            display: none;
        }

        #close-modal {
            position: absolute;
            background: white;
            width: 56px;
            height: 56px;
            margin-left: -28px;
            border-radius: 56px;
            top: 20px;
            left: 50%;
            color: red;
            font-size: 1.5em;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
        }

        #modal {
            position: absolute;
            width: 85%;
            height: 70%;
            background: white;
            z-index: 100;
            top: 50px;
            left: 50%;
            margin-left: -42%;
            border-radius: 0.6em;
            overflow-y: auto;
            padding: 0.5em 0 2em 0;
        }
    </style>

    <script src="<?php echo URL; ?>assets/js/modal.js"></script>
    <script>
        let links = document.getElementsByClassName("modal-option");
        let clickLinkFunction = function(event) {
            event.preventDefault();
            let link = this.getAttribute("href");
            openModal(link);
        };

        window.onload = function() {
            for (let link of links) {
                link.addEventListener("click", clickLinkFunction, 1);
            }

            document.getElementById("close-modal").addEventListener("click", closeModal, 1);
        }        
    </script>
</section>