

<script>
    msg = {nim: "<?= $nim ?>", registrasi: "<?= $registrasi ?>"};
    msg = JSON.stringify(msg); 

    conn.onopen = () => conn.send(msg);
</script>