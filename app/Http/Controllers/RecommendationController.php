<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecommendationController extends Controller
{
    // public function recommendCourses(Request $request)
    // {
    //     // $userDescription = DB::table('trainee')->where('id', $id)->value('t_description');
    //     $userDescription = "weight loss. I want to lose weight. I want to lose weight by working out.";

    //     if (!$userDescription) {
    //         return []; // Return an empty array if the user's description is not found
    //     }

    //     // Calculate TF-IDF scores for user's description
    //     $userTfidfScores = $this->calculateTfidfScores($userDescription);
    //     dd($userTfidfScores);
    //     // Query courses with similar TF-IDF scores
    //     $recommendedCourses = $recommendedCourses = DB::table('courses')
    //         ->crossJoin('trainees')
    //         ->where('trainees.t_description', 'like', "%$userDescription%")
    //         ->get();
    //     dd($recommendedCourses);
    //     return response()->json(['courses' => $recommendedCourses]);
    // }

    public function recommendCourses($traineeDescription)
    {
        $userDescription = $traineeDescription;
        // Calculate TF-IDF scores for the user's description
        $userTfidfScores = $this->calculateTfidfScores($userDescription);

        // Initialize an array to store the WHERE clauses
        $whereClauses = [];
            // Define a TF-IDF score threshold (adjust as needed)
            $tfidfThreshold = 0.5; // Example threshold

            // Initialize an array to store the WHERE clauses
            $whereClauses = [];

            // Loop through the terms and build the WHERE clauses for high TF-IDF terms
            foreach ($userTfidfScores as $term => $tfidfScore) {
                // Check if the TF-IDF score is above the threshold
                if ($tfidfScore >= $tfidfThreshold) {
                    // Use the term to build the LIKE clause
                    $likeClause = "courses.description LIKE '%$term%'";
                    // Add the LIKE clause to the array of WHERE clauses
                    $whereClauses[] = $likeClause;
                }
            }
        // dd($userTfidfScores);

        // Combine the WHERE clauses with OR conditions
        $whereCondition = implode(' OR ', $whereClauses);
        // dd($whereCondition);
        // Recommend courses based on the combined WHERE condition
        $recommendedCourses = DB::table('courses')
            // ->crossJoin('trainees')
            // ->where('trainees.t_description', 'like', "%$whereCondition%")
            ->whereRaw($whereCondition) // Apply the combined WHERE condition
            ->get();

        return response()->json(['courses' => $recommendedCourses]);
    }

    private function calculateTfidfScores($userDescription)
    {
        // remove stop words
        $cleanDescription = $this->removeStopWords($userDescription);
        // Tokenize the user's description
        $terms = str_word_count($cleanDescription, 1);

        // Calculate TF for each term
        $tf = array_count_values($terms);

        // Get the total number of course descriptions
        $totalDocuments = DB::table('courses')->count();

        // Initialize an array to store IDF values
        $idf = [];

        // Calculate IDF for each term
        foreach ($terms as $term) {
            $documentFrequency = DB::table('courses')
                ->where('description', 'like', "%$term%")
                ->count();
            $idf[$term] = $documentFrequency > 0 ? log($totalDocuments / $documentFrequency) : 0;
        }

        // Calculate TF-IDF scores for each term
        $tfidfScores = [];
        foreach ($tf as $term => $tfValue) {
            $tfidfScores[$term] = $tfValue * $idf[$term];
        }

        return $tfidfScores;
    }

    function removeStopWords($text)
    {
        $stopWords = [
            "a", "about", "above", "after", "again", "against", "ain't", "all", "am", "an", "and",
            "any", "are", "aren't", "aren't", "as", "at", "be", "because", "been", "before", "being",
            "below", "between", "both", "but", "by", "can't", "cannot", "could", "couldn't", "couldn't",
            "did", "didn't", "do", "does", "doesn't", "doing", "don't", "down", "during", "each", "few",
            "for", "from", "further", "had", "hadn't", "has", "hasn't", "have", "haven't", "having", "he",
            "he'd", "he'll", "he's", "her", "here", "here's", "hers", "herself", "him", "himself", "his",
            "how", "how's", "i", "i'd", "i'll", "i'm", "i've", "if", "in", "into", "is", "isn't", "it", "it's",
            "its", "itself", "let's", "me", "more", "most", "mustn't", "my", "myself", "no", "nor", "not", "of",
            "off", "on", "once", "only", "or", "other", "ought", "our", "ours", "ourselves", "out", "over", "own",
            "same", "shan't", "she", "she'd", "she'll", "she's", "should", "shouldn't", "so", "some", "such", "than",
            "that", "that's", "the", "their", "theirs", "them", "themselves", "then", "there", "there's", "these",
            "they", "they'd", "they'll", "they're", "they've", "this", "those", "through", "to", "too", "under",
            "until", "up", "very", "was", "wasn't", "we", "we'd", "we'll", "we're", "we've", "were", "weren't", "what",
            "what's", "when", "when's", "where", "where's", "which", "while", "who", "who's", "whom", "why", "why's",
            "with", "won't", "would", "wouldn't", "you", "you'd", "you'll", "you're", "you've", "your", "yours",
            "yourself", "yourselves"
        ];
        // Tokenize the input text into an array of words
        $words = str_word_count($text, 1);

        // Initialize an array to store non-stop words
        $filteredWords = [];

        // Loop through the words and filter out stop words
        foreach ($words as $word) {
            // Convert the word to lowercase to make the comparison case-insensitive
            $lowercaseWord = strtolower($word);

            // Check if the lowercase word is not in the list of stop words
            if (!in_array($lowercaseWord, $stopWords)) {
                // Add the non-stop word to the filteredWords array
                $filteredWords[] = $word;
            }
        }

        // Join the filtered words back into a string
        $filteredText = implode(' ', $filteredWords);

        return $filteredText;
    }


}
