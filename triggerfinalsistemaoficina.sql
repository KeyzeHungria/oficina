DELIMITER $$

CREATE TRIGGER trg_servico_tipo_pagamento
BEFORE UPDATE ON servico
FOR EACH ROW
BEGIN
  DECLARE v_nr_parcelas INT;
  DECLARE v_prazo_primeira INT;
  DECLARE v_intervalo INT;
  DECLARE v_juros DECIMAL(10,2);
  DECLARE v_valor_total_com_juros DECIMAL(10,2);
  DECLARE v_valor_parcela_base DECIMAL(10,2);
  DECLARE v_valor_ultima_parcela DECIMAL(10,2);
  DECLARE cont INT DEFAULT 1;
  DECLARE data DATE;

  IF NEW.idtipo_pagamento IS NOT NULL
     AND (OLD.pagamento_gerado IS NULL OR OLD.pagamento_gerado = 0) THEN

    IF NEW.valor_total IS NOT NULL AND NEW.valor_total > 0 THEN

      SELECT 
        nr_parcelas, prazo_primeira, intervalo, juros
      INTO 
        v_nr_parcelas, v_prazo_primeira, v_intervalo, v_juros
      FROM 
        tipo_pagamento
      WHERE 
        idtipo_pagamento = NEW.idtipo_pagamento;

      IF v_juros > 0 THEN
        SET v_valor_total_com_juros = ROUND(NEW.valor_total * (1 + (v_juros / 100)), 2);
      ELSE
        SET v_valor_total_com_juros = NEW.valor_total;
      END IF;

      SET v_valor_parcela_base = ROUND(v_valor_total_com_juros / v_nr_parcelas, 2);
      SET v_valor_ultima_parcela = v_valor_total_com_juros - (v_valor_parcela_base * (v_nr_parcelas - 1));

      SET data = DATE_ADD(NOW(), INTERVAL v_prazo_primeira DAY);

      WHILE cont <= v_nr_parcelas DO

        INSERT INTO pagamento (
          valor_parcela, 
          data_pagamento, 
          status_pagamento, 
          idservico,
          valor_pago
        )
        VALUES (
          IF(cont = v_nr_parcelas, v_valor_ultima_parcela, v_valor_parcela_base), 
          data, 
          'aberto', 
          NEW.idservico,
          0
        );

        SET cont = cont + 1;
        SET data = DATE_ADD(data, INTERVAL v_intervalo DAY);
      END WHILE;

      SET NEW.pagamento_gerado = 1;
    END IF;

  END IF;
END$$

DELIMITER ;