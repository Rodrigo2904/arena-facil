# TODO - Correção preço da quadra ficando negativo

## Plano aprovado
- Bloquear preço menor que zero (<= -?); regra: **valor menor que zero não pode**.

## Passos
1. Atualizar `api/quadras/salvar.php`:
   - Normalizar preço (aceitar vírgula decimal, remover espaços)
   - Validar: preço não pode ser < 0
   - Converter para número antes de inserir
   - Trocar INSERT concatenado por prepared statement (mysqli)
2. (Opcional) Ajustar `assets/js/cadastro_quadra.js` para enviar número/valor saneado.
3. Testar cadastrando quadra com preço negativo e positivo.
4. Fazer commit e push para o GitHub.

