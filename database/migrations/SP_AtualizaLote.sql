DELIMITER //
  CREATE PROCEDURE SP_AtualizaLote (id_prod int, qtde int, lote_prod varchar(30), validade_lote date)
BEGIN
    declare contador int(11);

    SELECT count(*) into contador FROM lotes WHERE lote = lote_prod;

    IF contador > 0 THEN
        UPDATE lotes SET qtd=qtd + qtde, produto_id= id_prod, lote = lote_prod, validade=validade_lote
        WHERE lote = lote_prod;
    ELSE
        INSERT INTO lotes (produto_id, qtd, lote, validade) values (id_prod, qtde, lote_prod, validade_lote);
    END IF;
END //
DELIMITER ;