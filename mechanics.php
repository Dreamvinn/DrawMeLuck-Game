<?php
include('session.php');

// Retrieve the Teacher ID from the session
$teacherId = $_SESSION['teacherId'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/icon.ico" />
    <title>Mechanics</title>
    <style>
        @media (min-width: 768px) {
            .a {
                flex: 0 0 50%;
                max-width: 100%;
            }

            .a {
                background-color: #002D04;
            }
        }

        .container {
            margin-top: -2%;
            width: 115vh;
            height: 80vh;
            overflow: auto;
            border: 1px solid black;
            font-family: 'Trebuchet MS';
            color: white;
            border: 0.5vh solid white;
            padding: 1.5vh;
            text-align: justify;
            margin-left: 10vh;
        }

        h4 {
            font-size: 150%;
            margin-top: 3%;
            margin-bottom: 1%;
        }

        hr {
            background-color: white;
            height: 1vh;
            width: 95%;
            border-style: solid white;
        }

        .bot {
            position: fixed;
            bottom: 2%;
            left: 0;
            right: 0;
        }

        .top {
            position: fixed;
            top: 2%;
            left: 0;
            right: 0;
        }

        .back {
            display: inline-block;
            background-color: white;
            color: #002D04;
            border: none;
            border-radius: 1vh !important;
            font-family: 'Trebuchet MS';
            font-weight: 1000;
            font-size: 220%;
            padding: 0px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-left: 2%;
            margin-top: 2%;
        }

        .back:hover {
            background-color: yellow;
        }

        h1 {
            margin-top: -2%;
            font-family: 'Trebuchet MS';
            color: white;
            font-size: 400%;
            margin-left: 10vh;
        }
    </style>
</head>

<body class="a">
    <audio src="./sfx/mainbg.mp3" autoplay loop></audio>
    <div class="top">
        <center>
            <hr>
        </center>
    </div>
    <button class="back" onclick="history.back()">Back</button>
    <center>
        <table>
            <tr>
                <td>
                    <h1>Mechanics</h1>
                </td>
                <td>
                    <div class="container">
                        <p style="margin-top: -2%;">
                        <h4>Grouping Phase</h4>
                        In a class, five (5) random players (students) should draw one (1) face-down numbered card each
                        from
                        their Game
                        Master (teacher). Then they should all show their chosen cards to their Game Master so the Game
                        Master could
                        list their names in columns based on the number they chose. After that, a new batch of five (5)
                        players should
                        do the same. This process should be repeated until the Game Master has listed all players.
                        The players should now be grouped based on the columns they are in from their Game Master’s
                        list.
                        There would be
                        a total of five (groups).

                        Draw Phase
                        Players should all vote on who would be the first representative of their groups. All
                        representatives should go
                        in front of the class to start the Draw Phase. Five (5) face-down cards would be on a table in
                        front
                        of the Game
                        Master. The turns of drawing cards would be based on their group number, the queue would proceed
                        incrementally.
                        If a group has the turn to draw a card from the table, they will be marked as “Active”. The
                        representative of
                        the Active group should choose among the five (cards) and look at the chosen card before showing
                        and
                        giving it
                        to the Game Master.

                        <h4>Question Phase</h4>
                        (This would only occur if the player has drawn a Question Card) If the player has drawn a
                        Question
                        Card, the
                        Game Master should read the question to the player once. Then, the Game Master should roll the
                        die
                        to get a
                        number. After that, the Game Master should flip a coin and see whether it landed on Heads or
                        Tails.
                        If the coin
                        landed on Heads, it would be equivalent to “hints”. If it landed on Tails, on the other hand, it
                        would be
                        equivalent to “chances”. If the coin landed on Heads, the Game Master should give a number of
                        hints
                        based on the
                        number on the rolled die. On the other hand, if it landed on Tails, the Game Master should give
                        the
                        player a
                        number of chances to answer based on the number on the rolled die. If it were “hints” that were
                        given to the
                        player, the player would have one chance to answer the question correctly within 15 seconds,
                        which
                        will start
                        after the Game Master had given all the hints. If it were “chances” that were given to the
                        player,
                        the player
                        would have a chance to answer the question correctly within fifteen (15 seconds) by default if
                        the
                        number on the
                        rolled die is one (1). Every number that would be added to one (1) would add three (3) seconds
                        on
                        the timer
                        (max: number=6, seconds=30). Regardless if the player has used all the chances within the given
                        time
                        or not, the
                        turn should be over and the Game Master should reveal the correct answer. The Game Master should
                        grant point/s
                        if the player got the answer correct. The number of given points would be based on the number on
                        the
                        Question
                        Card.
                        (After this phase, the Game Master should draw from the pile of cards and place the drawn card
                        on
                        the table to
                        replace the card that the previous player has drawn, then, the Draw Phase should now occur for
                        the
                        next group.
                        If all five (5) players have played already, all the groups should vote on their next
                        representatives before
                        proceeding to the Draw Phase again.)
                        If the player hasn’t been able to answer the question correctly, a Steal Round should occur (see
                        Steal Round
                        below).

                        <h4>Steal Round (under Question Phase)</h4>
                        (This would only occur if the player hasn’t been able to answer the question correctly) The Game
                        Master should
                        roll the die. The number on the rolled die would decide which group would have the privilege to
                        steal the chance
                        to answer the question. If the die landed on a six (6) then the group with the lowest points
                        should
                        have the
                        privilege in the Steal Round. If two (2) groups are tied in the lowest score, then the Game
                        Master
                        should let
                        their players choose between Heads or Tails and the players cannot have the same choice. Then,
                        the
                        Game Master
                        should toss the coin and give the privilege to the group who won the coin toss. If three (3) or
                        more
                        groups tied
                        on the lowest score, then the die should be re-rolled until a specific group has been chosen by
                        the
                        die. If the
                        group that has been chosen by the rolled die or the tossed coin is still the same group that has
                        drawn the card,
                        then they should vote on a different representative (prioritizing those who haven’t participated
                        yet) who will
                        replace their current Active player.
                        After a group has been chosen based on the rolled die or the tossed coin, the Game Master should
                        ask
                        the group
                        to vote on whether they will choose “Give” or “Take”. The group should decide within ten (10)
                        seconds. If the
                        group chose “Give”, they should all vote on which group they will pass the privilege to (this
                        decision should be
                        included within the 10 seconds given to them), then that group would be marked “Active” and
                        their
                        current player
                        should undergo the same process on the same question. If the group chosen from the die voted on
                        “Take”, then
                        they would be marked “Active” and their player should undergo the same process on the same
                        question.
                        Regardless if the Active player answered the same question correctly or incorrectly, the Steal
                        Round
                        should be
                        over, and the next group in the queue should enter the Draw Phase.
                        (If all five (5) players have played already, all the groups should vote on their next
                        representatives before
                        proceeding to the Draw Phase again)


                        <h4>Decision Phase</h4>
                        (This would only occur if the player has drawn a Decision Card) If the player has drawn a
                        Decision
                        Card (a
                        special card that adds two (2) points to a group’s score), the Game Master should ask the
                        player’s
                        group to vote
                        on whether they will choose “Give” or “Take”. The group should decide within 10 seconds. If the
                        group chose
                        “Give”, they should all vote on which group they will give the benefit of the card to (this
                        decision
                        should be
                        included within the 10 seconds given to them). If the group chose “Take”, then they will have
                        the
                        benefit of the
                        card.
                        After the two (2) points have been added to a group’s score, then this phase is over.
                        (After this phase, the Game Master should draw from the pile of cards and place the drawn card
                        on
                        the table to
                        replace the card that the previous player has drawn, then, the Draw Phase should now occur for
                        the
                        next group.
                        If all five (5) players have played already, all the groups should vote on their next
                        representatives before
                        proceeding to the Draw Phase again.)

                        <h4>Unlucky Instance</h4>
                        (This would only occur if the player has drawn an Unlucky Card) If the player has drawn an
                        Unlucky
                        Card, it
                        would simply just end their turn.
                        (After this instance, the Game Master should draw from the pile of cards and place the drawn
                        card on
                        the table
                        to replace the card that the previous player has drawn, then, the Draw Phase should now occur
                        for
                        the next
                        group. If all five (5) players have played already, all the groups should vote on their next
                        representatives
                        before proceeding to the Draw Phase again.)

                        <h4>Individual Scoring</h4>
                        Whenever points are acquired by a group, their current Active player should be granted one (1)
                        point
                        to be added
                        to the player’s individual score, regardless of how many points the Active player has won for
                        the
                        group.

                        <h4>Timer</h4>
                        All the instances that would involve a timer should be done by the Game Master only, showing the
                        timer to the
                        Active group without verbally counting. Any player who counts verbally to pressure the Active
                        group
                        would have a
                        deduction of one (1) point from the player’s individual score and a deduction of two (2) points
                        from
                        that
                        player’s group’s score.</p>
                    </div>
                </td>
            </tr>
        </table>
    </center>
    <div class="bot">
        <center>
            <hr>
        </center>
    </div>
</body>

</html>
