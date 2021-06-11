SELECT *
FROM PIZZA
WHERE NomPizza NOT IN
    /* Charger toutes les pizzas ne se trouvant pas dans la liste suivante */
    (
        SELECT NomPizza
        FROM PIZZA
            INNER JOIN INGREDIENT ON (
                PIZZA.IngBase1 = INGREDIENT.NomIngred
                OR PIZZA.IngBase2 = INGREDIENT.NomIngred
                OR PIZZA.IngBase3 = INGREDIENT.NomIngred
                OR PIZZA.IngBase4 = INGREDIENT.NomIngred
                OR PIZZA.IngBase5 = INGREDIENT.NomIngred
                OR PIZZA.IngOpt1 = INGREDIENT.NomIngred
                OR PIZZA.IngOpt2 = INGREDIENT.NomIngred
                OR PIZZA.IngOpt3 = INGREDIENT.NomIngred
                OR PIZZA.IngOpt4 = INGREDIENT.NomIngred
                OR PIZZA.IngOpt5 = INGREDIENT.NomIngred
            )
        where INGREDIENT.DateArchiv != 'utiliser'
            /* Sélectionner toutes les pizzas dont les ingrédients ne sont pas en "utiliser" */
    )