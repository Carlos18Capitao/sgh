#####TRIGGER ENTRADA DE PRODUTOS
DELIMITER //
CREATE TRIGGER `TRG_EntradaProduto_AI` AFTER INSERT ON `produto_entradas`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaLote (new.produto_id, new.qtd, new.lote,new.validade);
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER `TRG_EntradaProduto_AU` AFTER UPDATE ON `produto_entradas`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaLote (new.produto_id, new.qtd - old.qtd, new.lote,new.validade);
END //
DELIMITER ;


DELIMITER //
CREATE TRIGGER `TRG_EntradaProduto_AD` AFTER DELETE ON `produto_entradas`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaLote (old.produto_id, old.qtd * -1, old.lote, old.validade);
END //
DELIMITER ;

#####TRIGGER SAIDA DE PRODUTOS

DELIMITER //
CREATE TRIGGER `TRG_SaidaProduto_AI` AFTER INSERT ON `produto_saidas`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaLote (new.produto_id, new.qtd * -1, new.lote, new.validade);
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER `TRG_SaidaProduto_AU` AFTER UPDATE ON `produto_saidas`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaLote (new.produto_id, old.qtd - new.qtd, new.lote, new.validade);
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER `TRG_SaidaProduto_AD` AFTER DELETE ON `produto_saidas`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaLote (old.produto_id, old.qtd, old.lote, old.validade);
END //
DELIMITER ;